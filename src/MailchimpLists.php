<?php

namespace Mailchimp;

class MailchimpLists extends Mailchimp {

  /**
   * Gets information about all lists owned by the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/#read-get_lists
   */
  public function getLists($parameters = array()) {
    return $this->request('GET', '/lists', NULL, $parameters);
  }

  /**
   * Gets a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/#read-get_lists_list_id
   */
  public function getList($list_id, $parameters = array()) {
    $tokens = array(
      'list_id' => $list_id,
    );

    return $this->request('GET', '/lists/{list_id}', $tokens, $parameters);
  }

  /**
   * Gets information about all interest categories associated with a list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/interest-categories/#read-get_lists_list_id_interest_categories
   */
  public function getInterestCategories($list_id, $parameters = array()) {
    $tokens = array(
      'list_id' => $list_id,
    );

    return $this->request('GET', '/lists/{list_id}/interest-categories', $tokens, $parameters);
  }

  /**
   * Gets merge fields associated with a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/merge-fields/#read-get_lists_list_id_merge_fields
   */
  public function getMergeFields($list_id, $parameters = array()) {
    $tokens = array(
      'list_id' => $list_id,
    );

    return $this->request('GET', '/lists/{list_id}/merge-fields', $tokens, $parameters);
  }

  /**
   * Gets information about all members of a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#read-get_lists_list_id_members
   */
  public function getMembers($list_id, $parameters = array()) {
    $tokens = array(
      'list_id' => $list_id,
    );

    return $this->request('GET', '/lists/{list_id}/members', $tokens, $parameters);
  }

  /**
   * Gets information about a member of a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param string $email
   *   The member's email address.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#read-get_lists_list_id_members_subscriber_hash
   */
  public function getMemberInfo($list_id, $email, $parameters = array()) {
    $tokens = array(
      'list_id' => $list_id,
      'subscriber_hash' => md5(strtolower($email)),
    );

    return $this->request('GET', '/lists/{list_id}/members/{subscriber_hash}', $tokens, $parameters);
  }

  /**
   * Gets activity related to a member of a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param string $email
   *   The member's email address.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/activity/#read-get_lists_list_id_members_subscriber_hash_activity
   */
  public function getMemberActivity($list_id, $email, $parameters = NULL) {
    $tokens = array(
      'list_id' => $list_id,
      'subscriber_hash' => md5(strtolower($email)),
    );

    return $this->request('GET', '/lists/{list_id}/members/{subscriber_hash}/activity', $tokens, $parameters);
  }

  /**
   * Adds a new member to a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   * @param string $email
   *   The email address to add.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#create-post_lists_list_id_members
   */
  public function addMember($list_id, $email, $parameters = array()) {
    $tokens = array(
      'list_id' => $list_id,
    );

    $parameters += array(
      'status' => 'pending',
      'email_address' => $email,
    );

    return $this->request('POST', '/lists/{list_id}/members', $tokens, $parameters);
  }

}
