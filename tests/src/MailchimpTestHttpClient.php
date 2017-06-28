<?php

namespace Mailchimp\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mailchimp\http\MailchimpHttpClientInterface;
use Mailchimp\MailchimpAPIException;

/**
 * A dummy HTTP client used when running unit tests.
 * Does not make any real API requests.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTestHttpClient implements MailchimpHttpClientInterface {

  public $method;

  public $uri;

  public $options;

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

    $this->method = $method;
    $this->uri = $uri;
    $this->options = $options;

    return new MailchimpTestHttpResponse();
  }

}
