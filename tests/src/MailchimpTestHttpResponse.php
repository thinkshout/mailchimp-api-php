<?php

namespace Mailchimp\Tests;

use GuzzleHttp\Psr7\Response;
use Guzzlehttp\Psr7\Utils;
use Psr\Http\Message\StreamInterface;

/**
 * Test HTTP Response.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTestHttpResponse extends Response {

  public function getBody(): StreamInterface {
    return Utils::streamFor();
  }

}
