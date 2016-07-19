<?php

namespace Mailchimp\Tests;

class MailchimpTest extends \PHPUnit_Framework_TestCase {

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
    $this->assertEquals($mc::VERSION, '1.0.3');
    $this->assertEquals(json_decode(file_get_contents('composer.json'))->version, $mc::VERSION);
  }
}
