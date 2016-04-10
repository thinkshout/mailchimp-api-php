<?php

namespace Mailchimp;

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
  public function getCampaigns($parameters = array()) {
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
  public function getCampaign($campaign_id, $parameters = array()) {
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

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
  public function addCampaign($type, $recipients, $settings, $parameters = array(), $batch = FALSE) {
    $parameters += array(
      'type' => $type,
      'recipients' => $recipients,
      'settings' => $settings,
    );

    return $this->request('POST', '/campaigns', NULL, $parameters, $batch);
  }

  /**
   * Sets the HTML, plain-text, and template content for a MailChimp campaign.
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
  public function setCampaignContent($campaign_id, $parameters = array()) {
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

    return $this->request('PUT', '/campaigns/{campaign_id}/content', $tokens, $parameters);
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
  public function updateCampaign($campaign_id, $type, $recipients, $settings, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

    $parameters += array(
      'type' => $type,
      'recipients' => $recipients,
      'settings' => $settings,
    );

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
  public function sendTest($campaign_id, $test_emails, $send_type, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

    $parameters += array(
      'test_emails' => $test_emails,
      'send_type' => $send_type,
    );

    return $this->request('POST', '/campaigns/{campaign_id}/actions/test', $tokens, $parameters, $batch);
  }

  /**
   * Send a MailChimp campaign.
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
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

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
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

    return $this->request('DELETE', '/campaigns/{campaign_id}', $tokens);
  }

}
