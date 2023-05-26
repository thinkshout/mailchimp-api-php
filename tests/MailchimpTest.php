<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Mailchimp library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTest extends TestCase {

  /**
   * Tests library functionality for account information.
   */
  public function testGetAccount() {
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpApiUser($api_user);
    $mc->getAccount();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/', $mc->getClient()->uri);
  }

  /**
   * Test the version number.
   */
  public function testVersion() {
    $mc = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $this->assertEquals(json_decode(file_get_contents('composer.json'))->version, $mc::VERSION);
  }

}
