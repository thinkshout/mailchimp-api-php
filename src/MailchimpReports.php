<?php

namespace Mailchimp;

class MailchimpReports extends Mailchimp {

  public function getSummary() {
    return $this->request('GET', '/reports');
  }

}
