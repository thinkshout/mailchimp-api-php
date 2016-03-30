<?php

namespace Mailchimp;

class MailchimpCampaigns extends Mailchimp {

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
   * @param $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#create-post_campaigns
   */
  public function addCampaign($type, $recipients, $settings, $parameters = array()) {
    $parameters += array(
      'type' => $type,
      'recipients' => $recipients,
      'settings' => $settings,
    );

    return $this->request('POST', '/campaigns', NULL, $parameters);
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
   * @param $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/#edit-patch_campaigns_campaign_id
   */
  public function updateCampaign($campaign_id, $type, $recipients, $settings, $parameters = array()) {
    $tokens = array(
      'campaign_id' => $campaign_id,
    );

    $parameters += array(
      'type' => $type,
      'recipients' => $recipients,
      'settings' => $settings,
    );

    return $this->request('PATCH', '/campaigns/{campaign_id}', $tokens, $parameters);
  }

}
