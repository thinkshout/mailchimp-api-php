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

    return $this->request('GET', '/ecommerce/stores/{store_id}', $tokens, $parameters);
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
   * @param array $parameters
   *  Associative array of optional request parameters.
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
   * @param array $parameters
   *  Associative array of optional request parameters.
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
  public function deleteStore($store_id) {
    $tokens = array(
      'store_id' => $store_id,
    );

    return $this->request('DELETE', '/ecommerce/stores/{store_id}', $tokens);
  }

  /**
   * Get information about a store’s carts.
   *
   * @param array $store_id
   *   The ID of the store where the carts exist.
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
   * @param string $cart_id
   *   The ID of the cart.
   * @param array $parameters
   *  Associative array of optional request parameters.
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

  /**
   * Adds a new cart to a store.
   *
   * @param string $store_id
   * The ID for the store.
   * @param string $id
   *  The unique identifier for the cart.
   * @param object $customer .
   *  Information about a specific customer.
   * @param string $currency_code .
   *  The three-letter ISO 4217 code for the currency that the cart uses.
   * @param float $order_total
   *  The order total for the cart.
   * @param array $parameters
   *  Associative array of optional request parameters.
   * @param bool $batch
   * TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#create-post_ecommerce_stores_store_id_carts
   */
  public function addCart($store_id, $id, $customer, $currency_code, $order_total, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'store_id' => $store_id,
    );

    $parameters += array(
      'id' => $id,
      'customer' => $customer,
      'currency_code' => $currency_code,
      'order_total' => $order_total,
    );

    return $this->request('POST', '/ecommerce/stores/{store_id}/carts', $tokens, $parameters, $batch);
  }

  /**
   * Deletes a cart.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $cart_id
   *   The ID of the cart.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#delete-delete_ecommerce_stores_store_id_carts_cart_id
   */
  public function deleteCart($store_id, $cart_id) {
    $tokens = array(
      'store_id' => $store_id,
      'cart_id' => $cart_id,
    );

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/carts/{cart_id}', $tokens);
  }

  /**
   * Get information about a store's customers.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param array $parameters
   *  Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#read-get_ecommerce_stores_store_id_customers
   */
  public function getCustomers($store_id, $parameters = array()) {
    $tokens = array(
      'store_id' => $store_id,
    );

    return $this->request('GET', '/ecommerce/stores/{store_id}/customers', $tokens, $parameters);
  }

  /**
   * Get information about a specific customer.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param string $customer_id
   *  The ID of the customer.
   * @param array $parameters
   *  Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#read-get_ecommerce_stores_store_id_customers_customer_id
   */
  public function getCustomer($store_id, $customer_id, $parameters = array()) {
    $tokens = array(
      'store_id' => $store_id,
      'customer_id' => $customer_id,
    );

    return $this->request('GET', '/ecommerce/stores/' . $store_id . '/customers/' . $customer_id, $tokens, $parameters);
  }

  /**
   * Adds a new customer to a store.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param string $id
   *  A unique identifier for the customer.
   * @param string $email_address
   *  The customer's email address.
   * @param bool $opt_in_status
   *  The customer's opt-in status. This value will never overwrite the opt-in
   *  status of a pre-existing MailChimp list member, but will apply to list
   *  members that are added through the e-commerce API endpoints.
   * @param array $parameters
   *  Associative array of optional request parameters.
   * @param bool $batch
   *  TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#create-post_ecommerce_stores_store_id_customers
   */
  public function addCustomer($store_id, $id, $email_address, $opt_in_status, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'store_id' => $store_id,
    );

    $parameters += array(
      'id' => $id,
      'email_address' => $email_address,
      'opt_in_status' => $opt_in_status,
    );

    return $this->request('POST', '/ecommerce/stores/{store_id}/customers', $tokens, $parameters, $batch);
  }

  /**
   * Update a customer.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param string $customer_id
   *  The ID of the customer.
   * @param string $email_address
   *  The email address of the customer.
   * @param bool $opt_in_status
   *  The customer's opt-in status.
   * @param array $parameters
   *  Associative array of optional request parameters.
   * @param bool $batch
   *  TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#edit-patch_ecommerce_stores_store_id_customers_customer_id
   */
  public function updateCustomer($store_id, $customer_id, $email_address, $opt_in_status, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'store_id' => $store_id,
      'customer_id' => $customer_id,
    );

    $parameters += array(
      'email_address' => $email_address,
      'opt_in_status' => $opt_in_status,
    );

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/customers/{customer_id}', $tokens, $parameters, $batch);
  }

  /**
   * Deletes a customer from a store.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param string $customer_id
   *  The ID of the customer.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#delete-delete_ecommerce_stores_store_id_customers_customer_id
   */
  public function deleteCustomer($store_id, $customer_id) {
    $tokens = array(
      'store_id' => $store_id,
      'customer_id' => $customer_id,
    );

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/customers/{customer_id}', $tokens);
  }

  /**
   * Get information about a store's orders.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param array $parameters
   *  Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#read-get_ecommerce_stores_store_id_orders
   */
  public function getOrders($store_id, $parameters = array()) {
    $tokens = array(
      'store_id' => $store_id,
    );

    return $this->request('GET', '/ecommerce/stores/{store_id}/orders', $tokens, $parameters);
  }

  /**
   * Get information about a specific order.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param string $order_id
   *  The ID of the order.
   * @param array $parameters
   *  Associative array of optional request parameters.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#read-get_ecommerce_stores_store_id_orders_order_id
   */
  public function getOrder($store_id, $order_id, $parameters = array()) {
    $tokens = array(
      'store_id' => $store_id,
      'order_id' => $order_id,
    );

    return $this->request('GET', '/ecommerce/stores/' . $store_id . '/orders/' . $order_id, $tokens, $parameters);
  }

  /**
   * Add a new order to a store.
   *
   * @param string $store_id
   *  The ID of the store.
   * @param string $id
   *  A unique identifier for the order.
   * @param object $customer
   *  Information about a specific customer. This information will update any
   *  existing customer. If the customer doesn't exist in the store, a new
   *  customer will be created.
   * @param string $currency_code
   *  The three-letter ISO 4217 code for the currency that the store accepts.
   * @param float $order_total
   *  The total for the order.
   * @param array $lines
   *  An array of the order's line items.
   * @param array $parameters
   *  Associative array of optional request parameters.
   * @param bool $batch
   *  TRUE to create a new pending batch operation.
   *
   * @return object
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#create-post_ecommerce_stores_store_id_orders
   */
  public function addOrder($store_id, $id, $customer, $currency_code, $order_total, $lines, $parameters = array(), $batch = FALSE) {
    $tokens = array(
      'store_id' => $store_id,
    );

    $parameters += array(
      'id' => $id,
      'customer' => $customer,
      'currency_code' => $currency_code,
      'order_total' => $order_total,
      'lines' => $lines,
    );

    return $this->request('POST', '/ecommerce/stores/{store_id}/orders', $tokens, $parameters, $batch);
  }

  /**
   * Add a product to a store.
   *
   * @param string $store_id
   *  Store ID to add the product too. Required.
   * @param string $id
   *  Unique ID for the product. Required.
   * @param string $title
   *  Product title. Required.
   * @param array $variants
   *  An array of the product's variants
   * @param array $parameters
   *  An array of additional parameters. See API docs.
   *
   * @return object
   *
   *  @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/#
   */
  public function addProduct($store_id, $id, $title, $variants = array(), $parameters = array()){
    $tokens = array(
      'store_id' => $store_id,
    );

    $parameters += array(
      'id' => $id,
      'title' => $title,
      'variants' => $variants,
    );

    return $this->request('POST', '/ecommerce/stores/{store_id}/products', $tokens, $parameters);
  }

  /**
   * Get information about all products for a store.
   *
   * @param string $store_id
   *  Store ID
   *
   * @return object
   *
   *  @throws \Mailchimp\MailchimpAPIException
   */
  public function getProducts($store_id){
    $tokens = array(
      'store_id' => $store_id,
    );

    return $this->request('GET', '/ecommerce/stores/{store_id}/products', $tokens);
  }

  /**
   * Get information about a specific product.
   *
   * @param string $store_id
   *  Store ID.
   * @param string $product_id
   *  Product ID.
   *
   * @return object
   *
   * @throws \Mailchimp\MailchimpAPIException
   */
  public function getProduct($store_id, $product_id){
    $tokens = array(
      'store_id' => $store_id,
      'product_id' => $product_id,
    );

    return $this->request('GET', '/ecommerce/stores/{store_id}/products/{product_id}', $tokens);
  }

  /**
   * Delete a product.
   *
   * @param string $store_id
   *  Store ID.
   * @param string $product_id
   *  Product ID.
   *
   * @return object
   *
   * @throws \Mailchimp\MailchimpAPIException
   */
  public function deleteProduct($store_id, $product_id){
    $tokens = array(
      'store_id' => $store_id,
      'product_id' => $product_id,
    );

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/products/{product_id}', $tokens);
  }
}
