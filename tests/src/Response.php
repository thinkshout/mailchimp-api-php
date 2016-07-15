<?php

namespace Mailchimp\Tests;

/**
 * Test HTTP Response.
 *
 * @package Mailchimp\Tests
 */
class Response extends \GuzzleHttp\Psr7\Response {

  public function getBody() {
    return '{}';
  }

}
