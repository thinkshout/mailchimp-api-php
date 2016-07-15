<?php

namespace Mailchimp\Tests;

/**
 * MailChimp Ecommerce library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpEcommerce extends \Mailchimp\MailchimpEcommerce {

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

}
