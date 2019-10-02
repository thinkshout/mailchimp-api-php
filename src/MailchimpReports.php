<?php

namespace Mailchimp;

/**
 * Mailchimp Reports library.
 *
 * @package Mailchimp
 */
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

  /**
   * Gets a specific report for a specific campaign.
   *
   * @param string $campaign_id
   *   The ID of the campaign.
   * @param string $type
   *   The type of report to generate path url.
   *    - abuse-reports       @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/abuse-reports
   *    - advice              @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/advice
   *    - click-details       @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/click-details
   *    - domain-performance  @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/domain-performance
   *    - eepurl              @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/eepurl
   *    - email-activity      @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/email-activity
   *    - locations           @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/locations
   *    - sent-to             @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/sent-to
   *    - sub-reports         @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/sub-reports
   *    - unsubscribed        @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/unsubscribed
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   */
  public function getCampaignReport($campaign_id, $type, $parameters = []) {
    $tokens = [
      'campaign_id' => $campaign_id,
      'type' => $type,
    ];

    return $this->request('GET', '/reports/{campaign_id}/{type}', $tokens, $parameters);
  }

}
