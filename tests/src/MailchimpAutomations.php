<?php

namespace Mailchimp\Tests;

class MailchimpAutomations extends \Mailchimp\MailchimpAutomations {

  /**
   * Test HTTP client.
   *
   * @var \Mailchimp\http\MailchimpHttpClientInterface
   */
  private $client;

  /**
   * @inheritdoc
   */
  public function __construct($api_class = null) {
    $this->client = new MailchimpTestHttpClient();

    parent::__construct($api_class);
  }

  public function getClient() {
    return $this->api_class->client;
  }

  public function getEndpoint() {
    return 'https://us1.api.mailchimp.com/3.0';
  }

  /**
   * @inheritdoc
   */
  public function getAutomations($parameters = []) {
    $response = (object) [
      'automations' => [
        (object) [
          'id' => '57afe96172',
          'name' => 'Test Automation One',
        ],
        (object) [
          'id' => 'f4b7b26b2e',
          'name' => 'Test Automation Two',
        ],
        (object) [
          'id' => '587693d673',
          'name' => 'Test Automation Three',
        ],
      ],
      'total_items' => 3,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWorkflow($workflow_id) {
    $response = (object) [
      'id' => 'eb4c82c9d2',
      'create_time' => '2015-07-23T15:15:00+00:00',
      'start_time' => '',
      'status' => 'save',
      'emails_sent' => 0,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWorkflowEmails($workflow_id) {
    $response = (object) [
      'emails' => [
        (object) [
          'id' => 'a87de7d1e5',
          'workflow_id' => '57afe96172',
          'position' => 1,
          'status' => 'sending',
          'emails_sent' => 1,
          'send_time' => '2016-07-20T15:48:04+00:00',
          'content_type' => 'template',
        ],
      ],
      'total_items' => 1,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWorkflowEmail($workflow_id,$workflow_email_id) {
    $response = (object) [
      'id' => 'a87de7d1e5',
      'workflow_id' => '57afe96172',
      'position' => 1,
      'status' => 'sending',
      'emails_sent' => 1,
      'send_time' => '2016-07-20T15:48:04+00:00',
      'content_type' => 'template',
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWorkflowEmailSubscribers($workflow_id, $workflow_email_id) {
    $response = (object) [
      'workflow_id' => '4e3da78a41',
      'email_id' => 'a87de7d1e5',
      'queue' => [],
      'total_items' => 0,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $email) {
    $response = (object) [
      'id' => md5(strtolower($email)),
      'workflow_id' => '4e3da78a41',
      'email_id' => 'a87de7d1e5',
      'list_id' => '57afe96172',
      'email_address' => $email,
      'next_send' => '2017-04-28T15:48:04+00:00',
    ];

    return $response;
  }

}
