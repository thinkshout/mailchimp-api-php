<?php

namespace Mailchimp;

class MailchimpLists extends Mailchimp {

  /**
   * Gets a MailChimp list.
   *
   * @param string $list_id
   *   The ID of the list.
   *
   * @return object
   */
  public function getList($list_id) {
    $tokens = array(
      'list_id' => $list_id,
    );

    return $this->request('GET', '/lists/{list_id}', $tokens);
  }

}
