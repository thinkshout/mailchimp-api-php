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
  public function __construct($authentication_settings, $http_options = [], MailchimpHttpClientInterface $client = NULL) {
    $this->client = new MailchimpTestHttpClient();

    parent::__construct($authentication_settings, $http_options, $this->client);
  }

  public function getClient() {
    return $this->api_class->client;
  }

  public function getEndpoint() {
    return 'https://us1.api.mailchimp.com/3.0';
  }

}
