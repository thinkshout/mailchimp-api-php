<?php

namespace Mailchimp\Tests;

use Psr\Http\Message\StreamInterface;

/**
 * Test HTTP Response.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTestHttpResponse extends \GuzzleHttp\Psr7\Response {

  public function getBody(): StreamInterface {
    return '{}';
  }

}
