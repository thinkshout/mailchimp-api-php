<?php

namespace Mailchimp;

class MailchimpReports extends Mailchimp {

  /**
   * Gets a report summary for the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/#read-get_reports
   */
  public function getSummary($parameters = []) {
    return $this->request('GET', '/reports', NULL, $parameters);
  }

  /**
   * Gets a report summary for a specific campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/#read-get_reports_campaign_id
   */
  public function getCampaignSummary($campaign_id, $parameters = []) {
    $tokens = [
      'campaign_id' => $campaign_id,
    ];

    return $this->request('GET', '/reports/{campaign_id}', $tokens, $parameters);
  }

}
