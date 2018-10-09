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
  public function __construct($api_key = 'apikey', $api_user = 'apikey', $http_options = []) {
    $this->client = new MailchimpTestHttpClient();
  }

  public function getClient() {
    return $this->client;
  }

  public function getEndpoint() {
    return $this->endpoint;
  }

  /**
   * @inheritdoc
   */
  public function getStore($store_id, $parameters = []) {
    parent::getStore($store_id, $parameters);

    return (isset($this->stores[$store_id])) ? $this->stores[$store_id] : NULL;
  }

  /**
   * @inheritdoc
   */
  public function addStore($id, $store, $parameters = [], $batch = FALSE) {
    parent::addStore($id, $store, $batch);

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
    parent::getCustomer($store_id, $customer_id, $parameters);

    if (isset($this->customers[$store_id])) {
      return (isset($this->customers[$store_id][$customer_id])) ? $this->customers[$store_id][$customer_id] : NULL;
    }

    return NULL;
  }

  /**
   * @inheritdoc
   */
  public function addCustomer($store_id, $customer, $batch = FALSE) {
    parent::addCustomer($store_id, $customer, $batch);

    if (!isset($this->customers[$store_id])) {
      $this->customers[$store_id] = [];
    }

    $this->customers[$store_id][$customer['id']] = (object) $customer;
  }

  /**
   * @inheritdoc
   */
  public function getOrder($store_id, $order_id, $parameters = []) {
    parent::getOrder($store_id, $order_id, $parameters);

    if (isset($this->orders[$store_id])) {
      return (isset($this->orders[$store_id][$order_id])) ? $this->orders[$store_id][$order_id] : NULL;
    }

    return NULL;
  }

  /**
   * @inheritdoc
   */
  public function addOrder($store_id, $id, array $customer, array $order, $batch = FALSE) {
    parent::addOrder($store_id, $id, $customer, $order, $batch);

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
