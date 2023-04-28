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
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getLists();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for list information.
   */
  public function testGetList() {
    $list_id = '57afe96172';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getList($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for interest categories information.
   */
  public function testGetInterestCategories() {
    $list_id = '57afe96172';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getInterestCategories($list_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding new interest categories.
   */
  public function testAddInterestCategories() {
    $list_id = '57afe96172';
    $title = 'Test Interest Category';
    $type = 'checkbox';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->addInterestCategories($list_id, $title, $type);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($title, $request_body->title);
    $this->assertEquals($type, $request_body->type);
  }

  /**
   * Tests library functionality for updating interest categories.
   */
  public function testUpdateInterestCategories() {
    $list_id = '57afe96172';
    $title = 'Test Interest Category Edited';
    $type = 'dropdown';
    $interest_category_id = '08f0b1d7b2';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->updateInterestCategories($list_id, $interest_category_id, $title, $type);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id, $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($title, $request_body->title);
    $this->assertEquals($type, $request_body->type);
  }

  /**
   * Tests library functionality for deleting interest categories.
   */
  public function testDeleteInterestCategories() {
    $list_id = '57afe96172';
    $interest_category_id = '08f0b1d7b2';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->deleteInterestCategories($list_id, $interest_category_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for interests information.
   */
  public function testGetInterests() {
    $list_id = '';
    $interest_category_id = '';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getInterests($list_id, $interest_category_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id . '/interests', $mc->getClient()->uri);
  }

  /**
 * Tests library functionality for adding interests.
 */
  public function testAddInterests() {
    $list_id = '57afe96172';
    $interest_category_id = '08f0b1d7b2';
    $name = 'Test Interest';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->addInterests($list_id, $interest_category_id, $name);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id . '/interests', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($name, $request_body->name);
  }

  /**
   * Tests library functionality for updating interests.
   */
  public function testUpdateInterests() {
    $list_id = '57afe96172';
    $interest_category_id = '08f0b1d7b2';
    $interest_id = '9143cf3bd1';
    $name = 'Test Interest Edited';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->updateInterests($list_id, $interest_category_id, $interest_id, $name);

    $this->assertEquals('PATCH', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id . '/interests/' . $interest_id, $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($name, $request_body->name);
  }

  /**
   * Tests library functionality for deleting interests.
   */
  public function testDeleteInterests() {
    $list_id = '57afe96172';
    $interest_category_id = '08f0b1d7b2';
    $interest_id = '9143cf3bd1';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->deleteInterests($list_id, $interest_category_id, $interest_id);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/interest-categories/' . $interest_category_id . '/interests/' . $interest_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for merge fields information.
   */
  public function testGetMergeFields() {
    $list_id = '57afe96172';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getMemberActivity($list_id, $email);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/activity', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for member events information.
   */
  public function testGetMemberEvents() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getMemberEvents($list_id, $email);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/events', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding a list member.
   */
  public function testAddMember() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->addOrUpdateMember($list_id, $email);

    $this->assertEquals('PUT', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for member tags information.
   */
  public function testGetMemberTags() {
    $list_id = '57afe96172';
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->getMemberTags($list_id, $email);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/tags', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for list segment information.
   */
  public function testGetSegments() {
    $list_id = '57afe96172';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
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

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->addSegmentMember($list_id, $segment_id, $email);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments/' . $segment_id . '/members', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($email, $request_body->email_address);
  }

  /**
   * Tests library functionality for removing a segment member.
   */
  public function testRemoveSegmentMember() {
    $list_id = '205d96e6b4';
    $segment_id = '457';
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->removeSegmentMember($list_id, $segment_id, $email);

    $this->assertEquals('DELETE', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/segments/' . $segment_id . '/members/' . md5($email), $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for adding tags to a member.
   */
  public function testAddTagsMember() {
    $list_id = '205d96e6b4';
    $tags = ['Foo', 'Bar'];
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->addTagsMember($list_id, $tags, $email);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/tags', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $expected = [
      [
        'name' => 'Foo',
        'status' => 'active',
      ],
      [
        'name' => 'Bar',
        'status' => 'active',
      ],
    ];
    $this->assertEquals($expected, $request_body->tags);
  }

  /**
   * Tests library functionality for removing tags from a member.
   */
  public function testRemoveTagsMember() {
    $list_id = '205d96e6b4';
    $tags = ['Foo', 'Bar'];
    $email = 'test@example.com';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->removeTagsMember($list_id, $tags, $email);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/tags', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $expected = [
      [
        'name' => 'Foo',
        'status' => 'inactive',
      ],
      [
        'name' => 'Bar',
        'status' => 'inactive',
      ],
    ];
    $this->assertEquals($expected, $request_body->tags);
  }

  /**
   * Tests library functionality for adding a member event.
   */
  public function testAddMemberEvent() {
    $list_id = '205d96e6b4';
    $email = 'test@example.com';
    $event = [
        "name" => "registered_referral",
        "properties" => [
          "ref-code-123456"
        ],
      ];

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpLists($api_user);
    $mc->AddMemberEvent($list_id, $email, $event);

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/lists/' . $list_id . '/members/' . md5($email) . '/events', $mc->getClient()->uri);

    $this->assertNotEmpty($mc->getClient()->options['json']);

    $request_body = $mc->getClient()->options['json'];

    $this->assertEquals($event, (array) $request_body);
  }
}
