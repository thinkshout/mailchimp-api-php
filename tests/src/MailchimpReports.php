<?php

namespace Mailchimp\Tests;

/**
 * Mailchimp Reports library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpReports extends \Mailchimp\MailchimpReports {

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

}
