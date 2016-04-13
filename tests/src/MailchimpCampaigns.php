<?php

namespace Mailchimp\Tests;

class MailchimpCampaigns extends \Mailchimp\MailchimpCampaigns {

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
  public function getCampaign($campaign_id, $parameters = array()) {
    parent::getCampaign($campaign_id, $parameters);

    $response = (object) array(
      'id' => $campaign_id,
      'type' => 'regular',
      'recipients' => (object) array(
        'list_id' => '57afe96172',
      ),
      'settings' => (object) array(
        'subject_line' => 'Test Campaign',
      ),
      'tracking' => (object) array(
        'html_clicks' => TRUE,
        'text_clicks' => FALSE,
      ),
    );

    return $response;
  }

}
