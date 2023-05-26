<?php

namespace Mailchimp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Mailchimp Templates test library.
 *
 * @package Mailchimp\Tests
 */
class MailchimpTemplatesTest extends TestCase {

  /**
   * Tests library functionality for templates information.
   */
  public function testGetTemplates() {
    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpTemplates($api_user);
    $mc->getTemplates();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/templates', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for template information.
   */
  public function testGetTemplate() {
    $template_id = '2000094';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpTemplates($api_user);
    $mc->getTemplate($template_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/templates/' . $template_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for template content information.
   */
  public function testGetTemplateContent() {
    $template_id = '2000094';

    $api_user = new Mailchimp(['api_user' => null, 'api_key' => null]);
    $mc = new MailchimpTemplates($api_user);
    $mc->getTemplateContent($template_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/templates/' . $template_id . '/default-content', $mc->getClient()->uri);
  }

}
