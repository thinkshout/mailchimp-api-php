<?php

namespace Mailchimp\Tests;

use Mailchimp\MailchimpAPIException;

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
  public function getCampaigns($parameters = array()) {
    throw new MailchimpAPIException('Method not implemented in test library.');
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

  /**
   * @inheritdoc
   */
  public function addCampaign($type, $recipients, $settings, $parameters = array(), $batch = FALSE) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

  /**
   * @inheritdoc
   */
  public function setCampaignContent($campaign_id, $parameters = array()) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

  /**
   * @inheritdoc
   */
  public function updateCampaign($campaign_id, $type, $recipients, $settings, $parameters = array(), $batch = FALSE) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

  /**
   * @inheritdoc
   */
  public function sendTest($campaign_id, $test_emails, $send_type, $parameters = array(), $batch = FALSE) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

  /**
   * @inheritdoc
   */
  public function send($campaign_id, $batch = FALSE) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

  /**
   * @inheritdoc
   */
  public function delete($campaign_id) {
    throw new MailchimpAPIException('Method not implemented in test library.');
  }

}
