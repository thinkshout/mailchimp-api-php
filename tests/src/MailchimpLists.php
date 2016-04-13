<?php

namespace Mailchimp\Tests;

class MailchimpLists extends \Mailchimp\MailchimpLists {

  /**
   * @inheritdoc
   */
  public function __construct($api_key = 'apikey', $api_user = 'apikey', $timeout = 60) {
    $this->client = new Client();
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
  public function getLists($parameters = array()) {
    parent::getLists($parameters);

    $response = (object) array(
      'lists' => array(
        (object) array(
          'id' => '57afe96172',
          'name' => 'Test List One',
        ),
        (object) array(
          'id' => 'f4b7b26b2e',
          'name' => 'Test List Two',
        ),
        (object) array(
          'id' => '587693d673',
          'name' => 'Test List Three',
        ),
      ),
      'total_items' => 3,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getList($list_id, $parameters = array()) {
    parent::getList($list_id, $parameters);

    $response = (object) array(
      'id' => $list_id,
      'name' => 'Test List One',
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getInterestCategories($list_id, $parameters = array()) {
    parent::getInterestCategories($list_id, $parameters);

    $response = (object) array(
      'list_id' => $list_id,
      'categories' => array(
        (object) array(
          'list_id' => $list_id,
          'id' => 'a1e9f4b7f6',
          'title' => 'Test Interest Category',
        ),
      ),
      'total_items' => 1,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getInterests($list_id, $interest_category_id, $parameters = array()) {
    parent::getInterests($list_id, $interest_category_id, $parameters);

    $response = (object) array(
      'interests' => array(
        (object) array(
          'category_id' => $interest_category_id,
          'list_id' => $list_id,
          'id' => '9143cf3bd1',
          'name' => 'Test Interest',
        ),
      ),
      'total_items' => 1,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getMergeFields($list_id, $parameters = array()) {
    parent::getMergeFields($list_id, $parameters);

    $response = (object) array(
      'merge_fields' => array(
        (object) array(
          'merge_id' => 1,
          'tag' => 'FNAME',
          'list_id' => $list_id,
        ),
        (object) array(
          'merge_id' => 2,
          'tag' => 'LNAME',
          'list_id' => $list_id,
        ),
      ),
      'total_items' => 2,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getMemberInfo($list_id, $email, $parameters = array()) {
    parent::getMemberInfo($list_id, $email, $parameters);

    $response = (object) array(
      'id' => md5(strtolower($email)),
      'email_address' => $email,
      'status' => 'subscribed',
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addMember($list_id, $email, $parameters = array(), $batch = FALSE) {
    parent::addMember($list_id, $email, $parameters, $batch);

    $response = (object) array(
      'id' => md5(strtolower($email)),
      'email_address' => $email,
    );

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
  public function updateMember($list_id, $email, $parameters = array(), $batch = FALSE) {
    parent::updateMember($list_id, $email, $parameters, $batch);

    $response = (object) array(
      'id' => md5(strtolower($email)),
      'email_address' => $email,
    );

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addOrUpdateMember($list_id, $email, $parameters = array(), $batch = FALSE) {
    parent::addOrUpdateMember($list_id, $email, $parameters, $batch);

    $response = (object) array(
      'id' => md5(strtolower($email)),
      'email_address' => $email,
    );

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getSegments($list_id, $parameters = array()) {
    parent::getSegments($list_id, $parameters);

    $response = (object) array(
      'segments' => array(
        (object) array(
          'id' => 49377,
          'name' => 'Test Segment One',
          'type' => 'static',
          'list_id' => $list_id,
        ),
        (object) array(
          'id' => 49378,
          'name' => 'Test Segment Two',
          'type' => 'static',
          'list_id' => $list_id,
        ),
      ),
      'total_items' => 2,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addSegment($list_id, $name, $parameters = array(), $batch = FALSE) {
    parent::addSegment($list_id, $name, $parameters, $batch);

    $response = (object) array();

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
  public function updateSegment($list_id, $segment_id, $name, $parameters = array(), $batch = FALSE) {
    parent::updateSegment($list_id, $segment_id, $name, $parameters);

    $response = (object) array(
      'id' => $segment_id,
      'name' => $name,
      'member_count' => (isset($parameters['static_segment'])) ? count($parameters['static_segment']) : 0,
      'list_id' => $list_id,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function getWebhooks($list_id, $parameters = array()) {
    parent::getWebhooks($list_id, $parameters);

    $response = (object) array(
      'webhooks' => array(
        (object) array(
          'id' => '37b9c73a88',
          'url' => 'http://example.org',
          'events' => (object) array(
            'subscribe' => TRUE,
            'unsubscribe' => FALSE,
          ),
          'sources' => (object) array(
            'user' => TRUE,
            'api' => FALSE,
          ),
          'list_id' => $list_id,
        ),
      ),
      'total_items' => 1,
    );

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function addWebhook($list_id, $url, $parameters = array(), $batch = FALSE) {
    parent::addWebhook($list_id, $url, $parameters, $batch);

    $response = (object) array(
      'id' => 'ab24521a00',
      'url' => $url,
      'list_id' => $list_id,
    );

    foreach ($parameters as $key => $value) {
      $response->{$key} = $value;
    }

    return $response;
  }

  /**
   * @inheritdoc
   */
  public function deleteWebhook($list_id, $webhook_id, $parameters = array()) {
    parent::deleteWebhook($list_id, $webhook_id, $parameters);

    return (!empty($list_id) && !empty($webhook_id));
  }

}
