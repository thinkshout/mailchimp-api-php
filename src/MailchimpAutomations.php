<?php

namespace Mailchimp;

class MailchimpAutomations extends Mailchimp {

  /**
   * Gets information about all automations owned by the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/#read-get_automations
   */
  public function getAutomations($parameters = []) {
    return $this->request('GET', '/automations', NULL, $parameters);
  }

  /**
   * Get information about a specific Automation workflow.
   *
   * @param string $workflow_id
   *   The unique id for the Automation workflow.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/#read-get_automations_workflow_id
   */
  public function getWorkflow($workflow_id) {
    $tokens = [
      'workflow_id' => $workflow_id,
    ];

    return $this->request('GET', '/automations/{workflow_id}', $tokens);
  }

  /**
   * Gets a list of automated emails in a workflow.
   *
   * @param string $workflow_id
   *   The unique id for the Automation workflow.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/emails/#read-get_automations_workflow_id_emails
   */
  public function getWorkflowEmails($workflow_id) {
    $tokens = [
      'workflow_id' => $workflow_id,
    ];

    return $this->request('GET', '/automations/{workflow_id}/emails', $tokens);
  }

  /**
   * Gets information about a specific workflow email.
   *
   * @param string $workflow_id
   *   The unique id for the Automation workflow.
   * @param string $workflow_email_id
   *   The unique id for the Automation workflow email.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/emails/#read-get_automations_workflow_id_emails
   */
  public function getWorkflowEmail($workflow_id, $workflow_email_id) {
    $tokens = [
      'workflow_id' => $workflow_id,
      'workflow_email_id' => $workflow_email_id,
    ];

    return $this->request('GET', '/automations/{workflow_id}/emails/{workflow_email_id}', $tokens);
  }

  /**
   * Gets queued subscribers from a Mailchimp workflow automation.
   *
   * @param string $workflow_id
   *   The unique id for the Automation workflow.
   * @param string $workflow_email_id
   *   The unique id for the Automation workflow email.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/emails/queue/#read-get_automations_workflow_id_emails_workflow_email_id_queue
   */
  public function getWorkflowEmailSubscribers($workflow_id, $workflow_email_id) {
    $tokens = [
      'workflow_id' => $workflow_id,
      'workflow_email_id' => $workflow_email_id,
    ];

    return $this->request('GET', '/automations/{workflow_id}/emails/{workflow_email_id}/queue', $tokens);
  }

  /**
   * Gets a subscriber from a Mailchimp workflow automation email queue.
   *
   * @param string $workflow_id
   *   The unique id for the Automation workflow.
   * @param string $workflow_email_id
   *   The unique id for the Automation workflow email.
   * @param string $email
   *   The email address of the subscriber.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/emails/queue/#read-get_automations_workflow_id_emails_workflow_email_id_queue_subscriber_hash
   */
  public function getWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $email) {
    $tokens = [
      'workflow_id' => $workflow_id,
      'workflow_email_id' => $workflow_email_id,
      'subscriber_hash' => md5(strtolower($email)),
    ];

    return $this->request('GET', '/automations/{workflow_id}/emails/{workflow_email_id}/queue/{subscriber_hash}', $tokens);
  }

  /**
   * Adds a subscriber to a Mailchimp workflow automation email queue.
   *
   * @param string $workflow_id
   *   The unique id for the Automation workflow.
   * @param string $workflow_email_id
   *   The unique id for the Automation workflow email.
   * @param string $email
   *   The email address of the subscriber.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/automations/emails/queue/#create-post_automations_workflow_id_emails_workflow_email_id_queue
   */
  public function addWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $email, $parameters = []) {
    $tokens = [
      'workflow_id' => $workflow_id,
      'workflow_email_id' => $workflow_email_id,
    ];

    $parameters += [
      'email_address' => $email,
    ];

    return $this->request('POST', '/automations/{workflow_id}/emails/{workflow_email_id}/queue', $tokens, $parameters);
  }

}
