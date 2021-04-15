<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Mailchimp Campaign test library.
 *
 * @package Mailchimp\Tests
 */
class MailchimpCampaignsTest extends TestCase {

  /**
   * Tests library functionality for campaigns information.
   */
  public function testGetCampaigns() {
    $mc = new MailchimpCampaigns();
    $mc->getCampaigns();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for campaign information.
   */
  public function testGetCampaign() {
    $campaign_id = '42694e9e57';

    $mc = new MailchimpCampaigns();
    $mc->getCampaign($campaign_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding a new campaign.
   */
  public function testAddCampaign() {
    $type = 'regular';
    $recipients = (object) [
      'list_id' => '3c307a9f3f',
    ];
    $settings = (object) [
      'subject_line' => 'Your Purchase Receipt',
      'from_name' => 'Customer Service',
    ];

    $mc = new MailchimpCampaigns();
    $mc->addCampaign($type, $recipients, $settings);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($type, $request_body->type);

    $this->assertEquals($recipients->list_id, $request_body->recipients->list_id);
    $this->assertEquals($settings->subject_line, $request_body->settings->subject_line);
    $this->assertEquals($settings->from_name, $request_body->settings->from_name);
  }

  /**
   * Tests library functionality for getting campaign content.
   */
  public function testGetCampaignContent() {
    $campaign_id = '42694e9e57';

    $mc = new MailchimpCampaigns();
    $mc->getCampaignContent($campaign_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/content', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for setting campaign content.
   */
  public function testSetCampaignContent() {
    $campaign_id = '42694e9e57';
    $parameters = [
      'html' => '<p>The HTML to use for the saved campaign.</p>',
    ];

    $mc = new MailchimpCampaigns();
    $mc->setCampaignContent($campaign_id, $parameters);

    $this->assertEquals('PUT', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/content', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($parameters['html'], $request_body->html);
  }

  /**
   * Tests library functionality for getting a campaign send checklist.
   */
  public function testGetSendChecklist() {
    $campaign_id = '42694e9e57';

    $mc = new MailchimpCampaigns();
    $mc->getSendChecklist($campaign_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/send-checklist', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for updating a campaign.
   */
  public function testUpdateCampaign() {
    $campaign_id = '3e06f4ec92';
    $type = 'regular';
    $recipients = (object) [
      'list_id' => '3c307a9f3f',
    ];
    $settings = (object) [
      'subject_line' => 'This is an updated subject line',
      'from_name' => 'Customer Service',
    ];

    $mc = new MailchimpCampaigns();
    $mc->updateCampaign($campaign_id, $type, $recipients, $settings);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id, $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($type, $request_body->type);

    $this->assertEquals($recipients->list_id, $request_body->recipients->list_id);
    $this->assertEquals($settings->subject_line, $request_body->settings->subject_line);
    $this->assertEquals($settings->from_name, $request_body->settings->from_name);
  }

  /**
   * Tests library functionality for sending a test campaign.
   */
  public function testSendTest() {
    $campaign_id = 'b03bfc273a';
    $emails = [
      'test@example.com',
    ];
    $send_type = 'html';

    $mc = new MailchimpCampaigns();
    $mc->sendTest($campaign_id, $emails, $send_type);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/actions/test', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for scheduling a campaign.
   */
  public function testSchedule() {
    $campaign_id = 'b03bfc273a';
    $schedule_time = '2017-02-04T19:13:00+00:00';
    $timewarp = FALSE;
    $batch_delivery = (object) [
      'batch_delay' => 5,
      'batch_count' => 100,
    ];

    $mc = new MailchimpCampaigns();
    $mc->schedule($campaign_id, $schedule_time, $timewarp, $batch_delivery);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/actions/schedule', $mc->getClient()->uri);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($schedule_time, $request_body->schedule_time);
    $this->assertEquals($timewarp, $request_body->timewarp);
    $this->assertEquals($batch_delivery->batch_delay, $request_body->batch_delivery->batch_delay);
    $this->assertEquals($batch_delivery->batch_count, $request_body->batch_delivery->batch_count);
  }

  /**
   * Tests library functionality for unscheduling a campaign.
   */
  public function testUnschedule() {
    $campaign_id = 'b03bfc273a';

    $mc = new MailchimpCampaigns();
    $mc->unschedule($campaign_id);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/actions/unschedule', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for sending a campaign.
   */
  public function testSend() {
    $campaign_id = 'b03bfc273a';

    $mc = new MailchimpCampaigns();
    $mc->send($campaign_id);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id . '/actions/send', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for campaigns information.
   */
  public function testDelete() {
    $campaign_id = '42694e9e57';

    $mc = new MailchimpCampaigns();
    $mc->delete($campaign_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/campaigns/' . $campaign_id, $mc->getClient()->uri);
  }

}
