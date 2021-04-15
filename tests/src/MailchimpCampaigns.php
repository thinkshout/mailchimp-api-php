<?php

namespace Mailchimp\Tests;

/**
 * Mailchimp Campaigns library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpCampaigns extends \Mailchimp\MailchimpCampaigns {

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
  public function getCampaign($campaign_id, $parameters = []) {
    parent::getCampaign($campaign_id, $parameters);

    $response = (object) [
      'id' => $campaign_id,
      'type' => 'regular',
      'recipients' => (object) [
        'list_id' => '57afe96172',
      ],
      'settings' => (object) [
        'subject_line' => 'Test Campaign',
      ],
      'tracking' => (object) [
        'html_clicks' => TRUE,
        'text_clicks' => FALSE,
      ],
    ];

    return $response;
  }

}
