<?php

namespace Mailchimp;

/**
 * Mailchimp Templates library.
 *
 * @package Mailchimp
 */
class MailchimpTemplates extends Mailchimp {

  /**
   * Gets information about all templates owned by the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/templates/#read-get_templates
   */
  public function getTemplates($parameters = []) {
    return $this->request('GET', '/templates', NULL, $parameters);
  }

  /**
   * Gets information a specific template.
   *
   * @param string $template_id
   *   The ID of the template.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/templates/#read-get_templates_template_id
   */
  public function getTemplate($template_id, $parameters = []) {
    $tokens = [
      'template_id' => $template_id,
    ];

    return $this->request('GET', '/templates/{template_id}', $tokens, $parameters);
  }

  /**
   * Gets the default content of a specific template.
   *
   * @param string $template_id
   *   The ID of the template.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/templates/default-content/#read-get_templates_template_id_default_content
   */
  public function getTemplateContent($template_id, $parameters = []) {
    $tokens = [
      'template_id' => $template_id,
    ];

    return $this->request('GET', '/templates/{template_id}/default-content', $tokens, $parameters);
  }

}
