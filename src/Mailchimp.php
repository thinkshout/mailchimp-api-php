<?php

namespace Mailchimp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Mailchimp {

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
   * @var Client $client
   *   The GuzzleHttp Client.
   */
  protected $client;

  /**
   * @var string $endpoint
   *   The REST API endpoint.
   */
  protected $endpoint = 'https://us1.api.mailchimp.com/3.0';

  /**
   * @var string $api_key
   *   The MailChimp API key to authenticate with.
   */
  private $api_key;

  /**
   * @var string $api_user
   *   The MailChimp API username to authenticate with.
   */
  private $api_user;

  /**
   * @var string $debug_error_code
   *   A MailChimp API error code to return with every API response.
   *   Used for testing / debugging error handling.
   *   See ERROR_CODE_* constants.
   */
  private $debug_error_code;

  /**
   * @var array $batch_operations
   *   Array of pending batch operations.
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/batches/#create-post_batches
   */
  private $batch_operations;

  /**
   * Mailchimp constructor.
   *
   * @param string $api_key
   *   The MailChimp API key.
   *
   * @param string $api_user
   *   The MailChimp API username.
   *
   * @param int $timeout
   *   Maximum request time in seconds.
   */
  public function __construct($api_key, $api_user = 'apikey', $timeout = 10) {
    $this->api_key = $api_key;
    $this->api_user = $api_user;

    $dc = $this->getDataCenter($this->api_key);

    $this->endpoint = str_replace(Mailchimp::DEFAULT_DATA_CENTER, $dc, $this->endpoint);

    $this->client = new Client(array(
      'timeout' => $timeout,
    ));
  }

  /**
   * Sets a MailChimp error code to be returned by all requests.
   * Used to test and debug error handling.
   *
   * @param string $error_code
   *   The MailChimp error code.
   */
  public function setDebugErrorCode($error_code) {
    $this->debug_error_code = $error_code;
  }

  /**
   * Gets MailChimp account information for the authenticated account.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/root/#read-get_root
   */
  public function getAccount() {
    return $this->request('GET', '/');
  }

  /**
   * Processes all pending batch operations.
   *
   * @throws MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/batches/#create-post_batches
   */
  public function processBatchOperations() {
    $parameters = array(
      'operations' => $this->batch_operations,
    );

    try {
      $response = $this->request('POST', '/batches', NULL, $parameters);

      // Reset batch operations.
      $this->batch_operations = array();

      return $response;

    } catch (MailchimpAPIException $e) {
      $message = 'Failed to process batch operations: ' . $e->getMessage();
      throw new MailchimpAPIException($message, $e->getCode(), $e);
    }
  }

  /**
   * Gets the status of a batch request.
   *
   * @param $batch_id
   *   The ID of the batch operation.
   *
   * @return object
   */
  public function getBatchOperation($batch_id) {
    $tokens = array(
      'batch_id' => $batch_id,
    );

    return $this->request('GET', '/batches/{batch_id}', $tokens);
  }

  /**
   * Adds a pending batch operation.
   *
   * @param $method
   *   The HTTP method.
   * @param $path
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
  protected function addBatchOperation($method, $path, $parameters = array()) {
    if (empty($method) || empty($path)) {
      throw new MailchimpAPIException('Cannot add batch operation without a method and path.');
    }

    $op = (object) array(
      'method' => $method,
      'path' => $path,
    );

    if (!empty($parameters)) {
      if ($method == 'GET') {
        $op->params = (object) $parameters;
      }
      else {
        $op->body = json_encode($parameters);
      }
    }

    if (empty($this->batch_operations)) {
      $this->batch_operations = array();
    }

    $this->batch_operations[] = $op;

    return $op;
  }

  /**
   * Makes a request to the MailChimp API.
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
   *
   * @return object
   *
   * @throws MailchimpAPIException
   */
  protected function request($method, $path, $tokens = NULL, $parameters = NULL, $batch = FALSE) {
    if (!empty($tokens)) {
      foreach ($tokens as $key => $value) {
        $path = str_replace('{' . $key . '}', $value, $path);
      }
    }

    if ($batch) {
      return $this->addBatchOperation($method, $path, $parameters);
    }

    // Set default request options with auth header.
    $options = array(
      'headers' => array(
        'Authorization' => $this->api_user . ' ' . $this->api_key,
      ),
    );

    // Add trigger error header if a debug error code has been set.
    if (!empty($this->debug_error_code)) {
      $options['headers']['X-Trigger-Error'] = $this->debug_error_code;
    }

    if (!empty($parameters)) {
      if ($method == 'GET') {
        // Send parameters as query string parameters.
        $options['query'] = $parameters;
      }
      else {
        // Send parameters as JSON in request body.
        $options['json'] = (object) $parameters;
      }
    }

    try {
      $response = $this->client->request($method, $this->endpoint . $path, $options);
      $data = json_decode($response->getBody());

      return $data;

    } catch (RequestException $e) {
      $response = $e->getResponse();
      if (!empty($response)) {
        $message = $e->getResponse()->getBody();
      }
      else {
        $message = $e->getMessage();
      }

      throw new MailchimpAPIException($message, $e->getCode(), $e);
    }
  }

  /**
   * Gets the ID of the data center associated with an API key.
   *
   * @param string $api_key
   *   The MailChimp API key.
   *
   * @return string
   *   The data center ID.
   */
  private function getDataCenter($api_key) {
    $api_key_parts = explode('-', $api_key);

    return (isset($api_key_parts[1])) ? $api_key_parts[1] : Mailchimp::DEFAULT_DATA_CENTER;
  }

}
