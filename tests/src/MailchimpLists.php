<?php

namespace Mailchimp\Tests;

/**
 * Mailchimp Lists library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpLists extends \Mailchimp\MailchimpLists {

  /**
   * @inheritdoc
   */
  public function __construct($api_key = 'apikey', $api_user = 'apikey', $http_options = []) {
    $this->client = new MailchimpTestHttpClient();
  }

  public function getClient() {
    return $this->client;
  }

  public function getEndpoint() {
    return $this->endpoint;
  }

  /**
   * @inheritdoc
   */
  public function getLists($parameters = []) {
    parent::getLists($parameters);

    $response = (object) [
      'lists' => [
        (object) [
          'id' => '57afe96172',
          'name' => 'Test List One',
        ],
        (object) [
          'id' => 'f4b7b26b2e',
          'name' => 'Test List Two',
        ],
        (object) [
          'id' => '587693d673',
          'name' => 'Test List Three',
        ],
      ],
      'total_items' => 3,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getList($list_id, $parameters = []) {
    parent::getList($list_id, $parameters);

    $response = (object) [
      'id' => $list_id,
      'name' => 'Test List One',
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getInterestCategories($list_id, $parameters = []) {
    parent::getInterestCategories($list_id, $parameters);

    $response = (object) [
      'list_id' => $list_id,
      'categories' => [
        (object) [
          'list_id' => $list_id,
          'id' => 'a1e9f4b7f6',
          'title' => 'Test Interest Category',
        ],
      ],
      'total_items' => 1,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getInterests($list_id, $interest_category_id, $parameters = []) {
    parent::getInterests($list_id, $interest_category_id, $parameters);

    $response = (object) [
      'interests' => [
        (object) [
          'category_id' => $interest_category_id,
          'list_id' => $list_id,
          'id' => '9143cf3bd1',
          'name' => 'Test Interest',
        ],
      ],
      'total_items' => 1,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getMergeFields($list_id, $parameters = []) {
    parent::getMergeFields($list_id, $parameters);

    $response = (object) [
      'merge_fields' => [
        (object) [
          'merge_id' => 1,
          'tag' => 'FNAME',
          'list_id' => $list_id,
        ],
        (object) [
          'merge_id' => 2,
          'tag' => 'LNAME',
          'list_id' => $list_id,
        ],
      ],
      'total_items' => 2,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getMemberInfo($list_id, $email, $parameters = []) {
    parent::getMemberInfo($list_id, $email, $parameters);

    $response = (object) [
      'id' => md5(strtolower($email)),
      'email_address' => $email,
      'status' => 'subscribed',
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addMember($list_id, $email, $parameters = [], $batch = FALSE) {
    parent::addMember($list_id, $email, $parameters, $batch);

    $response = (object) [
      'id' => md5(strtolower($email)),
      'email_address' => $email,
    ];

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function removeMember($list_id, $email) {
    parent::removeMember($list_id, $email);
  }

  /**
   * @inheritdoc
   */
  public function updateMember($list_id, $email, $parameters = [], $batch = FALSE) {
    parent::updateMember($list_id, $email, $parameters, $batch);

    $response = (object) [
      'id' => md5(strtolower($email)),
      'email_address' => $email,
    ];

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addOrUpdateMember($list_id, $email, $parameters = [], $batch = FALSE) {
    parent::addOrUpdateMember($list_id, $email, $parameters, $batch);

    $response = (object) [
      'id' => md5(strtolower($email)),
      'email_address' => $email,
    ];

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getSegments($list_id, $parameters = []) {
    parent::getSegments($list_id, $parameters);

    $response = (object) [
      'segments' => [
        (object) [
          'id' => 49377,
          'name' => 'Test Segment One',
          'type' => 'static',
          'list_id' => $list_id,
        ],
        (object) [
          'id' => 49378,
          'name' => 'Test Segment Two',
          'type' => 'static',
          'list_id' => $list_id,
        ],
      ],
      'total_items' => 2,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getSegment($list_id, $segment_id, $parameters = []) {
    parent::getSegment($list_id, $segment_id, $parameters);

    $response = (object) [
      'id' => 49377,
      'name' => 'Test Segment One',
      'type' => 'static',
      'list_id' => $list_id,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addSegment($list_id, $name, $parameters = [], $batch = FALSE) {
    parent::addSegment($list_id, $name, $parameters, $batch);

    $response = (object) [];

    if (!empty($list_id) && !empty($name) && !empty($parameters['type'])) {
      $response->id = 49381;
      $response->name = $name;
      $response->type = $parameters['type'];
      $response->list_id = $list_id;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function updateSegment($list_id, $segment_id, $name, $parameters = [], $batch = FALSE) {
    parent::updateSegment($list_id, $segment_id, $name, $parameters);

    $response = (object) [
      'id' => $segment_id,
      'name' => $name,
      'member_count' => (isset($parameters['static_segment'])) ? count($parameters['static_segment']) : 0,
      'list_id' => $list_id,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWebhooks($list_id, $parameters = []) {
    parent::getWebhooks($list_id, $parameters);

    $response = (object) [
      'webhooks' => [
        (object) [
          'id' => '37b9c73a88',
          'url' => 'http://example.org',
          'events' => (object) [
            'subscribe' => TRUE,
            'unsubscribe' => FALSE,
          ],
          'sources' => (object) [
            'user' => TRUE,
            'api' => FALSE,
          ],
          'list_id' => $list_id,
        ],
      ],
      'total_items' => 1,
    ];

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addWebhook($list_id, $url, $parameters = [], $batch = FALSE) {
    parent::addWebhook($list_id, $url, $parameters, $batch);

    $response = (object) [
      'id' => 'ab24521a00',
      'url' => $url,
      'list_id' => $list_id,
    ];

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function deleteWebhook($list_id, $webhook_id, $parameters = []) {
    parent::deleteWebhook($list_id, $webhook_id, $parameters);

    return (!empty($list_id) && !empty($webhook_id));
  }

}
