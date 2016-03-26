<?php

namespace Mailchimp;

class MailchimpReports extends Mailchimp {

  /**
   * Gets a report summary for the authenticated account.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/#read-get_reports
   */
  public function getSummary() {
    return $this->request('GET', '/reports');
  }

}
