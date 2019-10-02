<?php

namespace Mailchimp;

/**
 * Mailchimp Campaigns library.
 *
 * @package Mailchimp
 */
class MailchimpCampaigns extends Mailchimp {

  const EMAIL_TYPE_HTML = 'html';
  const EMAIL_TYPE_PLAIN_TEXT = 'plain_text';

  const CAMPAIGN_TYPE_REGULAR = 'regular';
  const CAMPAIGN_TYPE_PLAINTEXT = 'plaintext';
  const CAMPAIGN_TYPE_ABSPLIT = 'absplit';
  const CAMPAIGN_TYPE_RSS = 'rss';
  const CAMPAIGN_TYPE_VARIATE = 'variate';

  /**
   * Gets information about all campaigns owned by the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#read-get_campaigns
   */
  public function getCampaigns($parameters = []) {
    return $this->request('GET', '/campaigns', NULL, $parameters);
  }

  /**
   * Gets information about a specific campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#read-get_campaigns_campaign_id
   */
  public function getCampaign($campaign_id, $parameters = []) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('GET', '/campaigns/{campaign_id}', $tokens, $parameters);
  }

  /**
   * Adds a new campaign to the authenticated account.
   *
   * @param string $type
   *   The campaign type. See CAMPAIGN_TYPE_* constants.
   * @param object $recipients
   *   List settings for the campaign.
   * @param object $settings
   *   The subject, from name, reply-to, etc settings for the campaign.
   * @param array $parameters
   *   Associative array of optional request parameters.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#create-post_campaigns
   */
  public function addCampaign($type, $recipients, $settings, $parameters = [], $batch = FALSE) {
    $parameters += [
      'type' => $type,
      'recipients' => $recipients,
      'settings' => $settings,
    ];

    return $this->request('POST', '/campaigns', NULL, $parameters, $batch);
  }

  /**
   * Gets the HTML, plain-text, and template content for a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/content/#read-get_campaigns_campaign_id_content
   */
  public function getCampaignContent($campaign_id, $parameters = []) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('GET', '/campaigns/{campaign_id}/content', $tokens, $parameters);
  }

  /**
   * Sets the HTML, plain-text, and template content for a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/content/#edit-put_campaigns_campaign_id_content
   */
  public function setCampaignContent($campaign_id, $parameters = []) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('PUT', '/campaigns/{campaign_id}/content', $tokens, $parameters);
  }

  /**
   * Get the send checklist for a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/send-checklist
   */
  public function getSendChecklist($campaign_id) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('GET', '/campaigns/{campaign_id}/send-checklist', $tokens, NULL);
  }

  /**
   * Updates a campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param string $type
   *   The campaign type. See CAMPAIGN_TYPE_* constants.
   * @param object $recipients
   *   List settings for the campaign.
   * @param object $settings
   *   The subject, from name, reply-to, etc settings for the campaign.
   * @param array $parameters
   *   Associative array of optional request parameters.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#edit-patch_campaigns_campaign_id
   */
  public function updateCampaign($campaign_id, $type, $recipients, $settings, $parameters = [], $batch = FALSE) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    $parameters += [
      'type' => $type,
      'recipients' => $recipients,
      'settings' => $settings,
    ];

    return $this->request('PATCH', '/campaigns/{campaign_id}', $tokens, $parameters, $batch);
  }

  /**
   * Sends a test email.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param array $test_emails
   *   Email addresses to send the test email to.
   * @param string $send_type
   *   The type of test email to send.
   * @param array $parameters
   *   Associative array of optional request parameters.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#action-post_campaigns_campaign_id_actions_test
   */
  public function sendTest($campaign_id, $test_emails, $send_type, $parameters = [], $batch = FALSE) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    $parameters += [
      'test_emails' => $test_emails,
      'send_type' => $send_type,
    ];

    return $this->request('POST', '/campaigns/{campaign_id}/actions/test', $tokens, $parameters, $batch);
  }

  /**
   * Schedule a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param schedule_time $schedule_time
   *   The date and time in UTC to schedule the campaign for delivery.
   * @param bool $timewarp
   *   Choose whether the campaign should use Timewarp when sending.
   * @param object $batch_delivery
   *   Choose whether the campaign should use Batch Delivery.
   *   Cannot be set to true for campaigns using Timewarp.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#action-post_campaigns_campaign_id_actions_schedule
   */
  public function schedule($campaign_id, $schedule_time, $timewarp = FALSE, $batch_delivery = FALSE, $parameters = [], $batch = FALSE) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    $parameters += [
      'schedule_time' => $schedule_time,
      'timewarp' => $timewarp,
      'batch_delivery' => $batch_delivery,
    ];

    return $this->request('POST', '/campaigns/{campaign_id}/actions/schedule', $tokens, $parameters, $batch);
  }

  /**
   * Unschedule a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#action-post_campaigns_campaign_id_actions_unschedule
   */
  public function unschedule($campaign_id) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('POST', '/campaigns/{campaign_id}/actions/unschedule', $tokens, NULL);
  }

  /**
   * Send a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#action-post_campaigns_campaign_id_actions_send
   */
  public function send($campaign_id, $batch = FALSE) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('POST', '/campaigns/{campaign_id}/actions/send', $tokens, NULL, $batch);
  }

  /**
   * Deletes a Mailchimp campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#delete-delete_campaigns_campaign_id
   */
  public function delete($campaign_id) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('DELETE', '/campaigns/{campaign_id}', $tokens);
  }

}
