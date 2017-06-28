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
    $mc = new MailchimpTemplates();
    $mc->getTemplates();

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/templates', $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for template information.
   */
  public function testGetTemplate() {
    $template_id = '2000094';

    $mc = new MailchimpTemplates();
    $mc->getTemplate($template_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/templates/' . $template_id, $mc->getClient()->uri);
  }

  /**
   * Tests library functionality for template content information.
   */
  public function testGetTemplateContent() {
    $template_id = '2000094';

    $mc = new MailchimpTemplates();
    $mc->getTemplateContent($template_id);

    $this->assertEquals('GET', $mc->getClient()->method);
    $this->assertEquals($mc->getEndpoint() . '/templates/' . $template_id . '/default-content', $mc->getClient()->uri);
  }

}
