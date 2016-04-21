<?php

namespace Mailchimp\Tests;

class MailchimpEcommerceTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests library functionality for stores information.
   */
  public function testGetStores() {
    $mc = new MailchimpEcommerce();
    $mc->getStores();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for store information.
   */
  public function testGetStore() {
    $store_id = 'MC002';

    $mc = new MailchimpEcommerce();
    $mc->getStore($store_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/store/' . $store_id, $mc->getClient()->uri);
  }

}
