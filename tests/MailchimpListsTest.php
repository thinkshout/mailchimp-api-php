<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Mailchimp Lists test library.
 *
 * @package Mailchimp\Tests
 */
class MailchimpListsTest extends TestCase {

  /**
   * Tests library functionality for lists information.
   */
  public function testGetLists() {
    $mc = new MailchimpLists();
    $mc->getLists();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for list information.
   */
  public function testGetList() {
    $list_id = '57afe96172';

    $mc = new MailchimpLists();
    $mc->getList($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for interest categories information.
   */
  public function testGetInterestCategories() {
    $list_id = '57afe96172';

    $mc = new MailchimpLists();
    $mc->getInterestCategories($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for interests information.
   */
  public function testGetInterests() {
    $list_id = '';
    $interest_category_id = '';

    $mc = new MailchimpLists();
    $mc->getInterests($list_id, $interest_category_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id . '/interests', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for merge fields information.
   */
  public function testGetMergeFields() {
    $list_id = '57afe96172';

    $mc = new MailchimpLists();
    $mc->getMergeFields($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/merge-fields', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding a merge field.
   */
  public function testAddMergeField() {
    $list_id = '57afe96172';
    $name = 'Phone number';
    $type = 'phone';

    $mc = new MailchimpLists();
    $mc->addMergeField($list_id, $name, $type);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/merge-fields', $mc->getClient()->uri);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($name, $request_body->name);
    $this->assertEquals($type, $request_body->type);
  }

  /**
   * Tests library functionality for members information.
   */
  public function testGetMembers() {
    $list_id = '57afe96172';

    $mc = new MailchimpLists();
    $mc->getMembers($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for member information.
   */
  public function testGetMemberInfo() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->getMemberInfo($list_id, $email);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for member activity information.
   */
  public function testGetMemberActivity() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->getMemberActivity($list_id, $email);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/activity', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding a list member.
   */
  public function testAddMember() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->addMember($list_id, $email);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($email, $request_body->email_address);
  }

  /**
   * Tests library functionality for removing a list member.
   */
  public function testRemoveMember() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->removeMember($list_id, $email);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for updating a list member.
   */
  public function testUpdateMember() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->updateMember($list_id, $email);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding or updating an existing list member.
   */
  public function testAddOrUpdateMember() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->addOrUpdateMember($list_id, $email);

    $this->assertEquals('PUT', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for list segment information.
   */
  public function testGetSegments() {
    $list_id = '57afe96172';

    $mc = new MailchimpLists();
    $mc->getSegments($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for list segment information.
   */
  public function testGetSegment() {
    $list_id = '57afe96172';
    $segment_id = '49377';

    $mc = new MailchimpLists();
    $mc->getSegment($list_id, $segment_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments/' . $segment_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding a list segment.
   */
  public function testAddSegment() {
    $list_id = '57afe96172';
    $name = 'Test Segment';

    $mc = new MailchimpLists();
    $mc->addSegment($list_id, $name);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($name, $request_body->name);
  }

  /**
   * Tests library functionality for updating a list segment.
   */
  public function testUpdateSegment() {
    $list_id = '57afe96172';
    $segment_id = '49381';
    $name = 'Updated Test Segment';

    $mc = new MailchimpLists();
    $mc->updateSegment($list_id, $segment_id, $name);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments/' . $segment_id, $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($name, $request_body->name);
  }

  /**
   * Tests library functionality for segment member information.
   */
  public function testGetSegmentMembers() {
    $list_id = '205d96e6b4';
    $segment_id = '457';

    $mc = new MailchimpLists();
    $mc->getSegmentMembers($list_id, $segment_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments/' . $segment_id . '/members', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding a segment member.
   */
  public function testAddSegmentMember() {
    $list_id = '205d96e6b4';
    $segment_id = '457';
    $email = 'test@example.com';

    $mc = new MailchimpLists();
    $mc->addSegmentMember($list_id, $segment_id, $email);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments/' . $segment_id . '/members', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($email, $request_body->email_address);
  }

}
