<?php

namespace Mailchimp;

use Mailchimp\http\MailchimpHttpClientInterface;
use Mailchimp\Mailchimp;

/**
 * Mailchimp API user class.
 *
 * @package Mailchimp
 */
class MailchimpApiUser {

  /**
   * The Mailchimp Api Class.
   *
   * @var MailchimpApiInterface $apiClass
   */
  protected $api_class;

  /**
   * Mailchimp API user constructor.
   *
   * @param MailchimpApiInterface $api_class
   *   The Mailchimp API Interface object.
   * @param array $authentication_settings
   *   Authentication settings.
   */
  public function __construct($api_class) {
    // Call classname and pass values to it.
    $this->api_class = $api_class;
  }

    /**
   * Sets a custom HTTP client to be used for all API requests.
   *
   * @param \Mailchimp\http\MailchimpHttpClientInterface $client
   *   The HTTP client.
   */
  public function setClient(MailchimpHttpClientInterface $client) {
    $this->api_class->client = $client;
  }

  /**
   * Sets a Mailchimp error code to be returned by all requests.
   *
   * Used to test and debug error handling.
   *
   * @param string $error_code
   *   The Mailchimp error code.
   */
  public function setDebugErrorCode($error_code) {
    $this->api_class->debug_error_code = $error_code;
  }

  /**
   * Gets Mailchimp account information for the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/root/#read-get_root
   */
  public function getAccount($parameters = []) {
    return $this->api_class->request('GET', '/', NULL, $parameters);
  }

  /**
   * Gets the status of a batch request.
   *
   * @param string $batch_id
   *   The ID of the batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/batches/#read-get_batches_batch_id
   */
  public function getBatchOperation($batch_id) {
    $tokens = [
      'batch_id' => $batch_id,
    ];

    return $this->api_class->request('GET', '/batches/{batch_id}', $tokens);
  }

    /**
   * Processes all pending batch operations.
   *
   * @throws MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/batches/#create-post_batches
   */
  public function processBatchOperations() {
    $parameters = [
      'operations' => $this->api_class->batch_operations,
    ];

    try {
      $response = $this->api_class->request('POST', '/batches', NULL, $parameters);

      // Reset batch operations.
      $this->api_class->batch_operations = [];

      return $response;

    }
    catch (MailchimpAPIException $e) {
      $message = 'Failed to process batch operations: ' . $e->getMessage();
      throw new MailchimpAPIException($message, $e->getCode(), $e);
    }
  }

  /**
   * Check if key or token is in place.
   *
   * @return bool
   *   If the access_token or api_key is set.
   */
  public function hasApiAccess() {
    switch (get_class($this->api_class)) {
      case 'Mailchimp\Mailchimp':
        return isset($this->api_class->api_key);
        break;
      case 'Mailchimp\Mailchimp2':
        return isset($this->api_class->access_token);
        break;
    }
  }

  /**
   * Passes on request to Mailchimp Api Interface.
   * This allows backwards compatibilty with existing calls.
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
    return $this->api_class->request($method, $path, $tokens = NULL, $parameters = [], $batch = FALSE, $returnAssoc = FALSE);
  }

}
