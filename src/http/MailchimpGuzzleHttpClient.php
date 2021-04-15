<?php

namespace Mailchimp\http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mailchimp\MailchimpAPIException;

/**
 * An HTTP client for use with the Mailchimp API using Guzzle.
 *
 * @package Mailchimp
 */
class MailchimpGuzzleHttpClient implements MailchimpHttpClientInterface {

  /**
   * The GuzzleHttp client.
   *
   * @var Client $client
   */
  private $guzzle;

  /**
   * MailchimpGuzzleHttpClient constructor.
   *
   * @param array $config
   *   Guzzle HTTP configuration options.
   *   Currently supports only 'timeout'.
   */
  public function __construct($config = []) {
    $this->guzzle = new Client($config);
  }

  /**
   * @inheritdoc
   */
  public function handleRequest($method, $uri = '', $options = [], $parameters = [], $returnAssoc = FALSE) {
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
      $response = $this->guzzle->request($method, $uri, $options);
      $data = json_decode($response->getBody(), $returnAssoc);

      return $data;
    }
    catch (RequestException $e) {
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

}
