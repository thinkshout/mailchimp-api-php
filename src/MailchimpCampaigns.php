<?php

namespace Mailchimp;

class MailchimpCampaigns extends Mailchimp {

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

}
