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
    $mc = new Mailchimp();
    $mc->getAccount();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/', $mc->getClient()->uri);
  }

  /**
   * Test the version number.
   */
  public function testVersion() {
    $mc = new Mailchimp();
    $this->assertEquals($mc::VERSION, '2.0.0');
    $this->assertEquals(json_decode(file_get_contents('composer.json'))->version, $mc::VERSION);
  }

}
