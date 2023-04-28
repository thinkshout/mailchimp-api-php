<?php

namespace Mailchimp\Tests;

class MailchimpApiUser extends \Mailchimp\MailchimpApiUser {

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