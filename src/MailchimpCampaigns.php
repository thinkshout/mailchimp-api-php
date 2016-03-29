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

}
