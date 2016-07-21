<?php

namespace Mailchimp\Tests;

/**
 * MailChimp Ecommerce library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpEcommerce extends \Mailchimp\MailchimpEcommerce {

  /**
   * Storage for stores. Used in place of real MailChimp API.
   *
   * @var array $stores
   */
  private $stores = [];

  /**
   * Storage for customers. Used in place of real MailChimp API.
   *
   * @var array $customers
   */
  private $customers = [];

  /**
   * @inheritdoc
   */
  public function __construct($api_key = 'apikey', $api_user = 'apikey', $timeout = 60) {
    $this->client = new Client();
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

    if (!empty($this->stores)) {
      var_dump('getStore');
      die(var_dump($this->stores));
    }

    return (isset($this->stores[$store_id])) ? $this->stores[$store_id] : NULL;
  }

  /**
   * @inheritdoc
   */
  public function addStore($id, $store, $batch = FALSE) {
    $parameters = [
      'id' => $id,
    ];
    $parameters += $store;

    $this->stores[$id] = $parameters;
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

    $this->customers[$store_id][$customer['id']] = $customer;
  }

}
