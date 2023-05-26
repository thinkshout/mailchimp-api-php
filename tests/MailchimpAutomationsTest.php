<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

class MailchimpAutomationsTest extends TestCase {

  /**
   * Tests library functionality for automations.
   */
  public function testGetAutomations() {
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->getAutomations();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for automation workflows.
   */
  public function testGetWorkflow() {
    $workflow_id = '57afe96172';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->getWorkflow($workflow_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations/' . $workflow_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for workflow automation emails.
   */
  public function testGetWorkflowEmails() {
    $workflow_id = '57afe96172';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->getWorkflowEmails($workflow_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations/' . $workflow_id . '/emails', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for a workflow automation email.
   */
  public function testGetWorkflowEmail() {
    $workflow_id = '57afe96172';
    $workflow_email_id = 'a87de7d1e5';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->getWorkflowEmail($workflow_id, $workflow_email_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations/' . $workflow_id . '/emails/' . $workflow_email_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for workflow automation email queues.
   */
  public function testGetWorkflowEmailSubscribers() {
    $workflow_id = '57afe96172';
    $workflow_email_id = 'a87de7d1e5';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->getWorkflowEmailSubscribers($workflow_id, $workflow_email_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations/' . $workflow_id . '/emails/' . $workflow_email_id . '/queue', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for a user in a workflow automation queue.
   */
  public function testGetWorkflowEmailSubscriber() {
    $workflow_id = '57afe96172';
    $workflow_email_id = 'a87de7d1e5';
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->getWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $email);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations/' . $workflow_id . '/emails/' . $workflow_email_id . '/queue/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for a user in a workflow automation queue.
   */
  public function testAddWorkflowEmailSubscriber() {
    $workflow_id = '57afe96172';
    $workflow_email_id = 'a87de7d1e5';
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpAutomations($api_user);
    $mc->addWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $email);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/automations/' . $workflow_id . '/emails/' . $workflow_email_id . '/queue', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($email, $request_body->email_address);
  }

}
