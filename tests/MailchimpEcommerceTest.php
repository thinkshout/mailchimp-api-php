<?php

namespace Mailchimp\Tests;

class MailchimpEcommerceTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests library functionality for report information.
   */
  public function testGetStores() {
    $mc = new MailchimpEcommerce();
    $mc->getStores();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores', $mc->getClient()->uri);
  }

