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
