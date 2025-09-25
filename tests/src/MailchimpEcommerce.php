<?php

namespace Mailchimp\Tests;

use Mailchimp\MailchimpAPIException;

/**
 * Mailchimp Ecommerce library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpEcommerce extends \Mailchimp\MailchimpEcommerce {

  /**
   * Test HTTP client.
   *
   * @var \Mailchimp\http\MailchimpHttpClientInterface
   */
  private $client;

  /**
   * Storage for stores. Used in place of real Mailchimp API.
   *
   * @var array $stores
   */
  private $stores = [];

  /**
   * Storage for customers. Used in place of real Mailchimp API.
   *
   * @var array $customers
   */
  private $customers = [];

  /**
   * Storage for orders. Used in place of real Mailchimp API.
   *
   * @var array $orders
   */
  private $orders = [];

  /**
   * @inheritdoc
   */
  public function __construct($api_class = null) {
    $this->client = new MailchimpTestHttpClient();

    parent::__construct($api_class);
  }
  
  public function getClient() {
    return $this->api_class->client;
  }

  public function getEndpoint() {
    return 'https://us1.api.mailchimp.com/3.0';
  }

  /**
   * @inheritdoc
   */
  public function getStore($store_id, $parameters = []) {
    return (isset($this->stores[$store_id])) ? $this->stores[$store_id] : NULL;
  }

  /**
   * @inheritdoc
   */
  public function addStore($id, $store, $parameters = [], $batch = FALSE) {
    $parameters = [
      'id' => $id,
    ];
    $parameters += $store;

    $this->stores[$id] = (object) $parameters;
  }

  /**
   * @inheritdoc
   */
  public function getCustomer($store_id, $customer_id, $parameters = []) {
    if (isset($this->customers[$store_id])) {
      return (isset($this->customers[$store_id][$customer_id])) ? $this->customers[$store_id][$customer_id] : NULL;
    }

    return NULL;
  }

  /**
   * @inheritdoc
   */
  public function addCustomer($store_id, $customer, $batch = FALSE) {
    if (!isset($this->customers[$store_id])) {
      $this->customers[$store_id] = [];
    }

    $this->customers[$store_id][$customer['id']] = (object) $customer;
  }

  /**
   * @inheritdoc
   */
  public function getOrder($store_id, $order_id, $parameters = []) {
    if (isset($this->orders[$store_id])) {
      return (isset($this->orders[$store_id][$order_id])) ? $this->orders[$store_id][$order_id] : NULL;
    }

    return NULL;
  }

  /**
   * @inheritdoc
   */
  public function addOrder($store_id, $id, array $customer, array $order, $batch = FALSE) {
    if (empty($store_id)) {
      throw new MailchimpAPIException('Store ID cannot be empty.');
    }

    if (empty($id)) {
      throw new MailchimpAPIException('Order ID cannot be empty.');
    }

    if (empty($customer)) {
      throw new MailchimpAPIException('Customer cannot be empty.');
    }

    if (empty($order)) {
      throw new MailchimpAPIException('Order cannot be empty.');
    }

    if (!isset($order['lines']) || empty($order['lines'])) {
      throw new MailchimpAPIException('Order must contain at least one line item.');
    }

    if (!isset($this->orders[$store_id])) {
      $this->orders[$store_id] = [];
    }

    $parameters = [
      'id' => $id,
      'customer' => (object) $customer,
    ];

    $parameters += $order;

    $this->orders[$store_id][$id] = (object) $parameters;
  }

}
