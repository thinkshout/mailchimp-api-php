<?php

namespace Mailchimp\Tests;

class Client extends \GuzzleHttp\Client {

  public $method;

  public $uri;

  public $options;

  /**
   * @inheritdoc
   */
  public function request($method, $uri = null, array $options = []) {
    $this->method = $method;
    $this->uri = $uri;
    $this->options = $options;

    return new Response();
  }

}
