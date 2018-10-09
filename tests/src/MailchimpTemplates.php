<?php

namespace Mailchimp\Tests;

/**
 * Mailchimp Templates library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTemplates extends \Mailchimp\MailchimpTemplates {

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
