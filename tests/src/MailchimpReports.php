<?php

namespace Mailchimp\Tests;

use Mailchimp\MailchimpAPIException;

class MailchimpReports extends \Mailchimp\MailchimpReports {

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
  public function getSummary($parameters = array()) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

  /**
   * @inheritdoc
   */
  public function getCampaignSummary($campaign_id, $parameters = array()) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

}
