<?php

namespace Mailchimp;

class MailchimpEcommerce extends Mailchimp {

  /**
   * Gets information about all stores in the account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#read-get_ecommerce_stores
   */
  public function getStores($parameters = array()) {
    return $this->request('GET', '/ecommerce/stores', NULL, $parameters);
  }

  /**
   * Gets information about a specific store.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/reports/#read-get_reports_campaign_id
   */
  public function getStore($store_id, $parameters = array()) {
    $tokens = array(
      'store_id' => $store_id,
    );

    return $this->request('GET', '/ecommerce/store/{store_id}', $tokens, $parameters);
  }

}
