<?php

namespace Mailchimp\Tests;

/**
 * Mailchimp connected sites library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpConnectedSites extends \Mailchimp\MailchimpConnectedSites {

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
