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
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#read-get_ecommerce_stores_store_id
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

  /**
   * Updates a store.
   *
   * @param string $store_id
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
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#edit-patch_ecommerce_stores_store_id
   */
  public function updateStore($store_id, $list_id, $name, $currency_code, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'store_id' => $store_id,
    );

    $parameters += array(
      'list_id' => $list_id,
      'name' => $name,
      'currency_code' => $currency_code,
    );

    return $this->request('PATCH', '/ecommerce/stores/{store_id}', $tokens, $parameters, $batch);
  }

  /**
   * Deletes a Mailchimp store.
   *
   * @param string $store_id
   *   The ID of the store.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#delete-delete_ecommerce_stores_store_id
   */
   public function delete($store_id) {
     $tokens = array(
       'store_id' => $store_id,
     );

     return $this->request('DELETE', '/ecommerce/stores/{store_id}', $tokens);
   }

   /**
    * 	Get information about a store’s carts.
    *
    * @param array $store_id
    *   The ID of the store where the carts exist.
    *
    * @param array $parameters
    *   Associative array of optional request parameters.
    *
    * @return object
    *
    * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#read-get_ecommerce_stores_store_id_carts
    */
   public function getCarts($store_id, $parameters = array()) {
     $tokens = array(
       'store_id' => $store_id,
     );

     return $this->request('GET', '/ecommerce/stores/{store_id}/carts', $tokens, $parameters);
   }

   /**
    * Get information about a specific cart.
    *
    * @param string $store_id
    *   The ID of the store.
    *
    * @param string $cart_id
    *   The ID of the cart.
    *
    * @return object
    *
    * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#read-get_ecommerce_stores_store_id_carts_cart_id
    */
    public function getCart($store_id, $cart_id, $parameters = array()) {
      $tokens = array(
        'store_id' => $store_id,
        'cart_id' => $cart_id,
      );

      return $this->request('GET', '/ecommerce/stores/{store_id}/carts/{cart_id}', $tokens, $parameters);
    }
}
