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

  /**
   * Adds a new store to the authenticated account.
   *
   * @param string $id
   *  The unique identifier for the store.
   * @param string $list_id
   *  The id for the list associated with the store.
   * @param string $name
   *  The name of the store.
   * @param string $currency_code
   *  The three-letter ISO 4217 code for the currency that the store accepts
   * @param bool $batch
   *  TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#create-post_ecommerce_stores
   */
  public function addStore($id, $list_id, $name, $currency_code, $parameters = array(), $batch = FALSE) {
    $parameters += array(
      'id' => $id,
      'list_id' => $list_id,
      'name' => $name,
      'currency_code' => $currency_code,
    );

    return $this->request('POST', '/ecommerce/stores', NULL, $parameters, $batch);
  }

}
