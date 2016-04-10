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
}
