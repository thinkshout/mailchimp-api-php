<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Mailchimp library test cases.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTest extends TestCase {

  /**
   * Tests library functionality for account information.
   */
  public function testGetAccount() {
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpApiUser($api_user);
    $mc->getAccount();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for API ping.
   */
  public function testPing() {
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpApiUser($api_user);
    $mc->ping();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/ping', $mc->getClient()->uri);
    $this->assertEquals(['timeout' => 10], $mc->getClient()->options['query']);
  }

  /**
   * Test the version number.
   */
  public function testVersion() {
    $mc = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $this->assertEquals(json_decode(file_get_contents('composer.json'))->version, $mc::VERSION);
  }

  /**
   * Tests that a batch request without an operation ID is unchanged.
   */
  public function testBatchOperationWithoutOperationId() {
    $mc = new \Mailchimp\Mailchimp(['api_user' => 'apikey', 'api_key' => 'abc-us1']);
    $op = $mc->request('POST', '/lists/{list_id}/members', ['list_id' => '57afe96172'], ['email_address' => 'a@example.com'], TRUE);

    $this->assertEquals('POST', $op->method);
    $this->assertEquals('/lists/57afe96172/members', $op->path);
    $this->assertFalse(property_exists($op, 'operation_id'));
    $this->assertCount(1, $mc->batch_operations);
  }

  /**
   * Tests that a non-boolean batch value is used as the operation ID.
   */
  public function testBatchOperationWithOperationId() {
    $mc = new \Mailchimp\Mailchimp(['api_user' => 'apikey', 'api_key' => 'abc-us1']);
    $op = $mc->request('POST', '/lists/{list_id}/members', ['list_id' => '57afe96172'], ['email_address' => 'a@example.com'], 'subscribe-a');
    $this->assertEquals('subscribe-a', $op->operation_id);
    $this->assertEquals('{"email_address":"a@example.com"}', $op->body);

    // Integer IDs, as suggested in the original request, are sent as strings.
    $op = $mc->request('DELETE', '/lists/57afe96172/members/abc', NULL, [], 42);
    $this->assertSame('42', $op->operation_id);

    $this->assertCount(2, $mc->batch_operations);
  }

  /**
   * Tests that resource methods pass an operation ID through to the batch.
   */
  public function testBatchOperationIdFromResourceMethod() {
    $mc = new \Mailchimp\Mailchimp(['api_user' => 'apikey', 'api_key' => 'abc-us1']);
    $lists = new \Mailchimp\MailchimpLists($mc);
    $lists->addMember('57afe96172', 'a@example.com', ['status' => 'subscribed'], 'member-a');

    $this->assertCount(1, $mc->batch_operations);
    $this->assertEquals('member-a', $mc->batch_operations[0]->operation_id);
    $this->assertEquals('/lists/57afe96172/members', $mc->batch_operations[0]->path);
  }

  /**
   * Tests that operation IDs are sent when pending operations are processed.
   */
  public function testProcessBatchOperationsSendsOperationId() {
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $api_user->request('PATCH', '/lists/57afe96172', NULL, ['name' => 'New name'], 'rename-list');
    $mc = new MailchimpApiUser($api_user);
    $mc->processBatchOperations();

    $this->assertEquals('POST', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/batches', $mc->getClient()->uri);
    $operations = $mc->getClient()->options['json']->operations;
    $this->assertCount(1, $operations);
    $this->assertEquals('rename-list', $operations[0]->operation_id);
  }

}
