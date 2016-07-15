<?php

namespace Mailchimp\Tests;

/**
 * Test HTTP client.
 *
 * @package Mailchimp\Tests
 */
class Client extends \GuzzleHttp\Client {

  public $method;

  public $uri;

  public $options;

  /**
   * @inheritdoc
   */
  public function request($method, $uri = NULL, array $options = []) {
    $this->method = $method;
    $this->uri = $uri;
    $this->options = $options;

    return new Response();
  }

}
