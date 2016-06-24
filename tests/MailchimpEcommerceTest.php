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
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for adding a new store.
   */
  public function testAddStore() {
    $id = 'MC001';
    $list_id = '205d96e6b4';
    $name = "Freddie'\''s Merchandise";
    $currency_code = 'USD';

    $mc = new MailchimpEcommerce();
    $mc->addStore($id, $list_id, $name, $currency_code);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($id, $request_body->id);
    $this->assertEquals($list_id, $request_body->list_id);
    $this->assertEquals($name, $request_body->name);
    $this->assertEquals($currency_code, $request_body->currency_code);
  }

  /**
   * Tests library functionality for updating a store.
   */
  public function testUpdateStore() {
    $store_id = 'MC001';
    $name = "Freddie'\''s Merchandise";
    $currency_code = 'USD';

    $mc = new MailchimpEcommerce();
    $mc->updateStore($store_id, $name, $currency_code);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id, $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($name, $request_body->name);
    $this->assertEquals($currency_code, $request_body->currency_code);
  }

  /**
   * Tests library functionality for deleting stores.
   */
  public function testDeleteStore() {
    $store_id = 'MC002';

    $mc = new MailchimpEcommerce();
    $mc->deleteStore($store_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for getting information on a store's carts.
   */
  public function testGetCarts() {
    $store_id = 'MC001';

    $mc = new MailchimpEcommerce();
    $mc->getCarts($store_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/carts', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for getting information on a specific cart.
   */
  public function testGetCart() {
    $store_id = 'MC001';
    $cart_id = 'cart0001';

    $mc = new MailchimpEcommerce();
    $mc->getCart($store_id, $cart_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/carts/' . $cart_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for adding a new cart.
   */
  public function testAddCart() {
    $store_id = 'MC001';
    $id = 'cart0001';
    $customer = (object) [
      'id' => 'cust0005',
      'email_address' => 'freddy@freddiesjokes.com',
      'opt_in_status' => TRUE,
    ];
    $currency_code = 'USD';
    $order_total = 12.45;

    $mc = new MailchimpEcommerce();
    $mc->addCart($store_id, $id, $customer, $currency_code, $order_total);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/carts', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($id, $request_body->id);
    $this->assertEquals($customer->id, $request_body->customer->id);
    $this->assertEquals($customer->email_address, $request_body->customer->email_address);
    $this->assertEquals($customer->opt_in_status, $request_body->customer->opt_in_status);
    $this->assertEquals($currency_code, $request_body->currency_code);
    $this->assertEquals($order_total, $request_body->order_total);
  }

  /**
   * Tests library function for deleting a cart.
   */
  public function testDeleteCart() {
    $store_id = 'MC001';
    $cart_id = 'cart0001';

    $mc = new MailchimpEcommerce();
    $mc->deleteCart($store_id, $cart_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndPoint() . '/ecommerce/stores/' . $store_id . '/carts/' . $cart_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for getting customers.
   */
  public function testGetCustomers() {
    $store_id = 'MC001';

    $mc = new MailchimpEcommerce();
    $mc->getCustomers($store_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndPoint() . '/ecommerce/stores/' . $store_id . '/customers', $mc->getClient()->uri);
  }

  /**
   * Tests library function for getting a customer.
   */
  public function testGetCustomer() {
    $store_id = 'MC001';
    $customer_id = 'cust0001';

    $mc = new MailchimpEcommerce();
    $mc->getCustomer($store_id, $customer_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/customers/' . $customer_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for adding a customer.
   */
  public function testAddCustomer() {
    $store_id = 'MC001';
    $id = 'cust0001';
    $email_address = 'freddie@freddiesjokes.com';
    $opt_in_status = TRUE;

    $mc = new MailchimpEcommerce();
    $mc->addCustomer($store_id, $id, $email_address, $opt_in_status);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/customers', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($id, $request_body->id);
    $this->assertEquals($email_address, $request_body->email_address);
    $this->assertEquals($opt_in_status, $request_body->opt_in_status);
  }

  /**
   * Tests library function for updating a customer.
   */
  public function testUpdateCustomer() {
    $store_id = 'MC001';
    $customer_id = 'cust0001';
    $email_address = 'freddie@freddiesjokes.com';
    $opt_in_status = TRUE;

    $mc = new MailchimpEcommerce();
    $mc->updateCustomer($store_id, $customer_id, $email_address, $opt_in_status);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/customers/' . $customer_id, $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($email_address, $request_body->email_address);
    $this->assertEquals($opt_in_status, $request_body->opt_in_status);
  }

  /**
   * Tests library function for deleting a customer.
   */
  public function testDeleteCustomer() {
    $store_id = 'MC001';
    $customer_id = 'cust0003';

    $mc = new MailchimpEcommerce();
    $mc->deleteCustomer($store_id, $customer_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndPoint() . '/ecommerce/stores/' . $store_id . '/customers/' . $customer_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for getting orders.
   */
  public function testGetOrders() {
    $store_id = 'MC001';

    $mc = new MailchimpEcommerce();
    $mc->getOrders($store_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/orders', $mc->getClient()->uri);
  }

  /**
   * Tests library function for getting an order.
   */
  public function testGetOrder() {
    $store_id = 'MC001';
    $order_id = 'ord0001';

    $mc = new MailchimpEcommerce();
    $mc->getOrder($store_id, $order_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/orders/' . $order_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for adding an order.
   */
  public function testAddOrder() {
    $store_id = 'MC001';
    $id = 'ord0001';
    $customer = (object) [
      'id' => 'cust0005',
      'email_address' => 'freddy@freddiesjokes.com',
      'opt_in_status' => TRUE,
    ];
    $currency_code = 'USD';
    $order_total = 12.45;
    $lines = [
      'id' => 'L001',
      'product_id' => 'PROD001',
      'product_variant_id' => 'PROD001A',
      'quantity' => 2,
      'price' => 10,
    ];

    $mc = new MailchimpEcommerce();
    $mc->addOrder($store_id, $id, $customer, $currency_code, $order_total, $lines);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/orders', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($id, $request_body->id);
    $this->assertEquals($customer->id, $request_body->customer->id);
    $this->assertEquals($customer->email_address, $request_body->customer->email_address);
    $this->assertEquals($customer->opt_in_status, $request_body->customer->opt_in_status);
    $this->assertEquals($currency_code, $request_body->currency_code);
    $this->assertEquals($order_total, $request_body->order_total);
    $this->assertEquals($lines['id'], $request_body->lines['id']);
    $this->assertEquals($lines['product_id'], $request_body->lines['product_id']);
    $this->assertEquals($lines['product_variant_id'], $request_body->lines['product_variant_id']);
    $this->assertEquals($lines['quantity'], $request_body->lines['quantity']);
    $this->assertEquals($lines['price'], $request_body->lines['price']);
  }

  /**
   * Tests library function for updating an order.
   */
  public function testsUpdateOrder() {
    $store_id = 'MC001';
    $order_id = 'ord0001';


    $mc = new MailchimpEcommerce();
    $mc->updateOrder($store_id, $order_id);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/orders/' . $order_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for deleting an order.
   */
  public function testDeleteOrder() {
    $store_id = 'MC002';
    $order_id = 'ord0001';

    $mc = new MailchimpEcommerce();
    $mc->deleteOrder($store_id, $order_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/orders/' . $order_id, $mc->getClient()->uri);
  }

  /**
   * Tests library function for getting order lines.
   */
  public function testGetOrderLines() {
    $store_id = 'MC001';
    $order_id = 'ord0001';

    $mc = new MailchimpEcommerce();
    $mc->getOrderLines($store_id, $order_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndPoint() . '/ecommerce/stores/' . $store_id . '/orders/' . $order_id . '/lines', $mc->getClient()->uri);
  }

  /**
   * Test getting all products.
   */
  public function testsGetProducts() {
    $store_id = 'MC001';
    $mc = new MailchimpEcommerce();
    $mc->getProducts($store_id);
    // Method must be GET.
    $this->assertEquals('GET', $mc->getClient()->method);
    // Confirm the URI being used.
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/products', $mc->getClient()->uri);
  }

  /**
   * Test getting information on a single product.
   */
  public function testGetProduct() {
    $store_id = 'MC001';
    $product_id = 'sku0001';
    $mc = new MailchimpEcommerce();
    $mc->getProduct($store_id, $product_id);
    // Method must be GET.
    $this->assertEquals('GET', $mc->getClient()->method);
    // Confirm the URI being used.
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/products/' . $product_id, $mc->getClient()->uri);
  }

  /**
   * Test adding a product.
   */
  public function testAddProduct() {
    $store_id = 'MC001';
    $product_id = 'sku0001';
    $title = 'Test Product 001';
    $mc = new MailchimpEcommerce();
    $mc->addProduct($store_id, $product_id, $title);
    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/products', $mc->getClient()->uri);
    $this->assertNotEmpty($mc->getClient()->options['json']);
    $request_body = $mc->getClient()->options['json'];
    $this->assertEquals($product_id, $request_body->id);
    $this->assertEquals($title, $request_body->title);
  }

  /**
   * Test deleting a product.
   */
  public function testDeleteProduct() {
    $store_id = 'MC001';
    $product_id = 'sku0001';
    $mc = new MailchimpEcommerce();
    $mc->deleteProduct($store_id, $product_id);
    // Method must be DELETE.
    $this->assertEquals('DELETE', $mc->getClient()->method);
    // Confirm URI being used.
    $this->assertEquals($mc->getEndpoint() . '/ecommerce/stores/' . $store_id . '/products/' . $product_id, $mc->getClient()->uri);
  }
}
