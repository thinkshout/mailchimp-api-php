<?php

namespace Mailchimp\Tests;

class MailchimpReportsTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tests library functionality for report information.
   */
  public function testGetSummary() {
    $mc = new MailchimpReports();
    $mc->getSummary();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/reports', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for campaign report information.
   */
  public function testCampaignSummary() {
    $campaign_id = '42694e9e57';

    $mc = new MailchimpReports();
    $mc->getCampaignSummary($campaign_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/reports/' . $campaign_id, $mc->getClient()->uri);
  }

}
