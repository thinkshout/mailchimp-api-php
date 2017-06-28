<?php

namespace Mailchimp\Tests;

/**
 * Test Mailchimp library.
 *
 * @package Mailchimp\Tests
 */
class Mailchimp extends \Mailchimp\Mailchimp {

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

}
