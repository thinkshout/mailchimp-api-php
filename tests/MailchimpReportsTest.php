<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Mailchimp Reports test library.
 *
 * @package Mailchimp\Tests
 */
class MailchimpReportsTest extends TestCase {

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

  /**
   * Tests library functionality for campaign report information.
   */
  public function testCampaignReport() {
    $campaign_id = '42694e9e57';
    $type = 'email-activity';

    $mc = new MailchimpReports();
    $mc->getCampaignReport($campaign_id, $type);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/reports/' . $campaign_id . '/' . $type, $mc->getClient()->uri);
  }

}
