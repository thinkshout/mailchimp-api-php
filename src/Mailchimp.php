<?php

namespace Mailchimp;

use Mailchimp\http\MailchimpCurlHttpClient;
use Mailchimp\http\MailchimpGuzzleHttpClient;
use Mailchimp\http\MailchimpHttpClientInterface;
use Mailchimp\MailchimpApiInterface;

/**
 * Mailchimp library.
 *
 * @package Mailchimp
 */
class Mailchimp implements MailchimpApiInterface {

  const VERSION = '3.0.0';
  const DEFAULT_DATA_CENTER = 'us1';

  const ERROR_CODE_BAD_REQUEST = 'BadRequest';
  const ERROR_CODE_INVALID_ACTION = 'InvalidAction';
  const ERROR_CODE_INVALID_RESOURCE = 'InvalidResource';
  const ERROR_CODE_JSON_PARSE_ERROR = 'JSONParseError';
  const ERROR_CODE_API_KEY_MISSING = 'APIKeyMissing';
  const ERROR_CODE_API_KEY_INVALID = 'APIKeyInvalid';
  const ERROR_CODE_FORBIDDEN = 'Forbidden';
  const ERROR_CODE_USER_DISABLED = 'UserDisabled';
  const ERROR_CODE_WRONG_DATACENTER = 'WrongDatacenter';
  const ERROR_CODE_RESOURCE_NOT_FOUND = 'ResourceNotFound';
  const ERROR_CODE_METHOD_NOT_ALLOWED = 'MethodNotAllowed';
  const ERROR_CODE_RESOURCE_NESTING_TOO_DEEP = 'ResourceNestingTooDeep';
  const ERROR_CODE_INVALID_METHOD_OVERRIDE = 'InvalidMethodOverride';
  const ERROR_CODE_REQUESTED_FIELDS_INVALID = 'RequestedFieldsInvalid';
  const ERROR_CODE_TOO_MANY_REQUESTS = 'TooManyRequests';
  const ERROR_CODE_INTERNAL_SERVER_ERROR = 'InternalServerError';
  const ERROR_CODE_COMPLIANCE_RELATED = 'ComplianceRelated';

  /**
   * API version.
   *
   * @var string $version
   */
  public $version = self::VERSION;

  /**
   * The HTTP client.
   *
   * @var MailchimpHttpClientInterface $client
   */
  public $client;

  /**
   * The REST API endpoint.
   *
   * @var string $endpoint
   */
  protected $endpoint = 'https://us1.api.mailchimp.com/3.0';

  /**
   * The Mailchimp API key to authenticate with.
   *
   * @var string $api_key
   */
  public $api_key;

  /**
   * The Mailchimp API username to authenticate with.
   *
   * @var string $api_user
   */
  private $api_user;

  /**
   * A Mailchimp API error code to return with every API response.
   *
   * Used for testing / debugging error handling.
   * See ERROR_CODE_* constants.
   *
   * @var string $debug_error_code
   */
  private $debug_error_code;

  /**
   * Authentication settings.
   *
   * @var array $authentication_settings
   */
  protected $authentication_settings;

  /**
   * Array of pending batch operations.
   *
   * @var array $batch_operations
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/batches/#create-post_batches
   */
  private $batch_operations;

  /**
   * Mailchimp constructor.
   *
   * @param array $authentication_settings
   *   Authentication settings.
   * @param array $http_options
   *   HTTP client options.
   * @param MailchimpHttpClientInterface $client
   *   Optional custom HTTP client. $http_options are ignored if this is set.
   */
  public function __construct($authentication_settings, $http_options = [], MailchimpHttpClientInterface $client = NULL) {
    $this->api_key = $authentication_settings['api_key'];
    $this->api_user = $authentication_settings['api_user'];

    $dc = $this->getDataCenter($this->api_key);

    $this->endpoint = str_replace(Mailchimp::DEFAULT_DATA_CENTER, (string) $dc, $this->endpoint);

    if (!empty($client)) {
      $this->client = $client;
    }
    else {
      $this->client = $this->getDefaultHttpClient($http_options);
    }
  }

  /**
   * Adds a pending batch operation.
   *
   * @param string $method
   *   The HTTP method.
   * @param string $path
   *   The request path, relative to the API endpoint.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The new batch operation object.
   *
   * @throws MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/batches/#create-post_batches
   */
  protected function addBatchOperation($method, $path, $parameters = []) {
    if (empty($method) || empty($path)) {
      throw new MailchimpAPIException('Cannot add batch operation without a method and path.');
    }

    $op = (object) [
      'method' => $method,
      'path' => $path,
    ];

    if (!empty($parameters)) {
      if ($method == 'GET') {
        $op->params = (object) $parameters;
      }
      else {
        $op->body = json_encode($parameters);
      }
    }

    if (empty($this->batch_operations)) {
      $this->batch_operations = [];
    }

    $this->batch_operations[] = $op;

    return $op;
  }

  /**
   * Makes a request to the Mailchimp API.
   *
   * @param string $method
   *   The REST method to use when making the request.
   * @param string $path
   *   The API path to request.
   * @param array $tokens
   *   Associative array of tokens and values to replace in the path.
   * @param array $parameters
   *   Associative array of parameters to send in the request body.
   * @param bool $batch
   *   TRUE if this request should be added to pending batch operations.
   * @param bool $returnAssoc
   *   TRUE to return Mailchimp API response as an associative array.
   *
   * @return mixed
   *   Object or Array if $returnAssoc is TRUE.
   *
   * @throws MailchimpAPIException
   */
  public function request($method, $path, $tokens = NULL, $parameters = [], $batch = FALSE, $returnAssoc = FALSE) {
    if (!empty($tokens)) {
      foreach ($tokens as $key => $value) {
        $path = str_replace('{' . $key . '}', $value, $path);
      }
    }

    if ($batch) {
      return $this->addBatchOperation($method, $path, $parameters);
    }

    // Set default request options with auth header.
    $options = [
      'headers' => [
        'Authorization' => $this->api_user . ' ' . $this->api_key,
      ],
    ];

    // Add trigger error header if a debug error code has been set.
    if (!empty($this->debug_error_code)) {
      $options['headers']['X-Trigger-Error'] = $this->debug_error_code;
    }

    return $this->client->handleRequest($method, $this->endpoint . $path, $options, $parameters, $returnAssoc);
  }

  /**
   * Gets the ID of the data center associated with an API key.
   *
   * @param string $api_key
   *   The Mailchimp API key.
   *
   * @return string
   *   The data center ID.
   */
  private function getDataCenter($api_key) {
    $api_key_parts = explode('-', (string) $api_key);

    return (isset($api_key_parts[1])) ? $api_key_parts[1] : Mailchimp::DEFAULT_DATA_CENTER;
  }

  /**
   * Instantiates a default HTTP client based on the local environment.
   *
   * @param array $http_options
   *   HTTP client options.
   *
   * @return MailchimpHttpClientInterface
   *   The HTTP client.
   */
  private function getDefaultHttpClient($http_options) {
    // Process HTTP options.
    // Handle deprecated 'timeout' argument.
    if (is_int($http_options)) {
      $http_options = [
        'timeout' => $http_options,
      ];
    }

    // Default timeout is 10 seconds.
    $http_options += [
      'timeout' => 10,
    ];

    $client = NULL;

    // Use cURL HTTP client if PHP version is below 5.5.0.
    // Use Guzzle client otherwise.
    if (version_compare(phpversion(), '5.5.0', '<')) {
      $client = new MailchimpCurlHttpClient($http_options);
    }
    else {
      $client = new MailchimpGuzzleHttpClient($http_options);
    }

    return $client;
  }

}
