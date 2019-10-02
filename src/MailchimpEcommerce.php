<?php

namespace Mailchimp;

/**
 * Mailchimp Ecommerce library.
 *
 * @package Mailchimp
 */
class MailchimpEcommerce extends Mailchimp {

  /**
   * Gets information about all stores in the account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API store response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#read-get_ecommerce_stores
   */
  public function getStores($parameters = []) {
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
   *   The API store response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#read-get_ecommerce_stores_store_id
   */
  public function getStore($store_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}', $tokens, $parameters);
  }

  /**
   * Adds a new store to the authenticated account.
   *
   * @param string $id
   *   A unique identifier for the store.
   * @param array $store
   *   Associative array of store information.
   *   - list_id (string) The id for the list associated with the store.
   *   - name (string) The name of the store.
   *   - currency_code (string) The three-letter ISO 4217 code for the currency
   *     that the store accepts.
   * @param array $parameters
   *   Associative array of optional request parameters.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API store response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#create-post_ecommerce_stores
   */
  public function addStore($id, $store, $parameters = [], $batch = FALSE) {
    $parameters['id'] = $id;
    $parameters += $store;

    return $this->request('POST', '/ecommerce/stores', NULL, $parameters, $batch);
  }

  /**
   * Updates a store.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $name
   *   The name of the store.
   * @param string $currency_code
   *   The three-letter ISO 4217 code for the currency that the store accepts.
   * @param array $parameters
   *   Associative array of optional request parameters.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API store response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#edit-patch_ecommerce_stores_store_id
   */
  public function updateStore($store_id, $name, $currency_code, $parameters = [], $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
    ];

    $parameters += [
      'name' => $name,
      'currency_code' => $currency_code,
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}', $tokens, $parameters, $batch);
  }

  /**
   * Deletes a Mailchimp store.
   *
   * @param string $store_id
   *   The ID of the store.
   *
   * @return object
   *   The API store response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/#delete-delete_ecommerce_stores_store_id
   */
  public function deleteStore($store_id) {
    $tokens = [
      'store_id' => $store_id,
    ];

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
   *   The API cart response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#read-get_ecommerce_stores_store_id_carts
   */
  public function getCarts($store_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

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
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API cart response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#read-get_ecommerce_stores_store_id_carts_cart_id
   */
  public function getCart($store_id, $cart_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/carts/{cart_id}', $tokens, $parameters);
  }

  /**
   * Adds a new cart to a store.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $id
   *   The unique identifier for the cart.
   * @param array $customer
   *   Associative array of customer information.
   *   - id (string): A unique identifier for the customer.
   * @param array $cart
   *   Associative array of cart information.
   *   - currency_code (string): The three-letter ISO 4217 currency code.
   *   - order_total (float): The total for the order.
   *   - lines (array): An array of the order's line items.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API cart response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#create-post_ecommerce_stores_store_id_carts
   */
  public function addCart($store_id, $id, array $customer, array $cart, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
    ];

    $parameters = [
      'id' => $id,
      'customer' => (object) $customer,
    ];

    $parameters += $cart;

    return $this->request('POST', '/ecommerce/stores/{store_id}/carts', $tokens, $parameters, $batch);
  }

  /**
   * Updates a specific cart.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $cart_id
   *   The unique identifier for the cart.
   * @param array $parameters
   *   Associative array of optional request parameters.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API cart response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#edit-patch_ecommerce_stores_store_id_carts_cart_id
   */
  public function updateCart($store_id, $cart_id, $parameters = [], $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/carts/{cart_id}', $tokens, $parameters, $batch);
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
   *   The API cart response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/#delete-delete_ecommerce_stores_store_id_carts_cart_id
   */
  public function deleteCart($store_id, $cart_id) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/carts/{cart_id}', $tokens);
  }

  /**
   * Get information about a cart's line items.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $cart_id
   *   The unique identifier for the cart.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API cart line response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/lines/#read-get_ecommerce_stores_store_id_carts_cart_id_lines
   */
  public function getCartLines($store_id, $cart_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/carts/{cart_id}/lines', $tokens, $parameters);
  }

  /**
   * Get information about a specific cart line item.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $cart_id
   *   The unique identifier for the cart.
   * @param string $line_id
   *   The unique identifier for the line item of a cart.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API cart line response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/lines/#read-get_ecommerce_stores_store_id_carts_cart_id_lines_line_id
   */
  public function getCartLine($store_id, $cart_id, $line_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
      'line_id' => $line_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/carts/{cart_id}/lines/{line_id}', $tokens, $parameters);
  }

  /**
   * Add a new line item to an existing cart.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $cart_id
   *   The unique identifier for the cart.
   * @param string $id
   *   A unique identifier for the order line item.
   * @param array $product
   *   Associative array of product information.
   *   - product_id (string) The unique identifier for the product.
   *   - product_variant_id (string) The unique id for the product variant.
   *   - quantity (int) The quantity of a cart line item.
   *   - price (float) The price of a cart line item.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API cart line response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/lines/#create-post_ecommerce_stores_store_id_carts_cart_id_lines
   */
  public function addCartLine($store_id, $cart_id, $id, $product, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
    ];

    $parameters = [
      'id' => $id,
    ];

    $parameters += $product;

    return $this->request('POST', '/ecommerce/stores/{store_id}/carts/{cart_id}/lines', $tokens, $parameters, $batch);
  }

  /**
   * Updates an existing line item in a cart.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $cart_id
   *   The unique identifier for the cart.
   * @param string $line_id
   *   A unique identifier for the order line item.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API cart line response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/lines/#edit-patch_ecommerce_stores_store_id_carts_cart_id_lines_line_id
   */
  public function updateCartLine($store_id, $cart_id, $line_id, $parameters = [], $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
      'line_id' => $line_id,
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/carts/{cart_id}/lines/{line_id}', $tokens, $parameters, $batch);
  }

  /**
   * Deletes a line item in a cart.
   *
   * @param string $store_id
   *   The unique identifier for the store.
   * @param string $cart_id
   *   The unique identifier for the cart.
   * @param string $line_id
   *   A unique identifier for the order line item.
   *
   * @return object
   *   The API cart line response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/carts/lines/#delete-delete_ecommerce_stores_store_id_carts_cart_id_lines_line_id
   */
  public function deleteCartLine($store_id, $cart_id, $line_id) {
    $tokens = [
      'store_id' => $store_id,
      'cart_id' => $cart_id,
      'line_id' => $line_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/carts/{cart_id}/lines/{line_id}', $tokens);
  }

  /**
   * Get information about a store's customers.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API customer response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#read-get_ecommerce_stores_store_id_customers
   */
  public function getCustomers($store_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/customers', $tokens, $parameters);
  }

  /**
   * Get information about a specific customer.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $customer_id
   *   The ID of the customer.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API customer response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#read-get_ecommerce_stores_store_id_customers_customer_id
   */
  public function getCustomer($store_id, $customer_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'customer_id' => $customer_id,
    ];

    return $this->request('GET', '/ecommerce/stores/' . $store_id . '/customers/' . $customer_id, $tokens, $parameters);
  }

  /**
   * Adds a new customer to a store.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $customer
   *   An associative array of customer information.
   *   - id (string) A unique identifier for the customer.
   *   - email_address (string) The customer's email address.
   *   - opt_in_status (boolean) The customer's opt-in status. This value will
   *     never overwrite the opt-in status of a pre-existing Mailchimp list
   *     member, but will apply to list members that are added through the
   *     e-commerce API endpoints.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API customer response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#create-post_ecommerce_stores_store_id_customers
   */
  public function addCustomer($store_id, $customer, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
    ];

    return $this->request('POST', '/ecommerce/stores/{store_id}/customers', $tokens, $customer, $batch);
  }

  /**
   * Update a customer.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $customer
   *   An associative array of customer information.
   *   - email_address (string) The customer's email address.
   *   - opt_in_status (boolean) The customer's opt-in status. This value will
   *     never overwrite the opt-in status of a pre-existing Mailchimp list
   *     member, but will apply to list members that are added through the
   *     e-commerce API endpoints.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API customer response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#edit-patch_ecommerce_stores_store_id_customers_customer_id
   */
  public function updateCustomer($store_id, $customer, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'customer_id' => $customer['id'],
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/customers/{customer_id}', $tokens, $customer, $batch);
  }

  /**
   * Deletes a customer from a store.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $customer_id
   *   The ID of the customer.
   *
   * @return object
   *   The API customer response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/customers/#delete-delete_ecommerce_stores_store_id_customers_customer_id
   */
  public function deleteCustomer($store_id, $customer_id) {
    $tokens = [
      'store_id' => $store_id,
      'customer_id' => $customer_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/customers/{customer_id}', $tokens);
  }

  /**
   * Get information about a store's orders.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API order response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#read-get_ecommerce_stores_store_id_orders
   */
  public function getOrders($store_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/orders', $tokens, $parameters);
  }

  /**
   * Get information about a specific order.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $order_id
   *   The ID of the order.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API order response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#read-get_ecommerce_stores_store_id_orders_order_id
   */
  public function getOrder($store_id, $order_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'order_id' => $order_id,
    ];

    return $this->request('GET', '/ecommerce/stores/' . $store_id . '/orders/' . $order_id, $tokens, $parameters);
  }

  /**
   * Add a new order to a store.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $id
   *   A unique identifier for the order.
   * @param array $customer
   *   Associative array of customer information.
   *   - id (string): A unique identifier for the customer.
   * @param array $order
   *   Associative array of order information.
   *   - currency_code (string): The three-letter ISO 4217 currency code.
   *   - order_total (float): The total for the order.
   *   - lines (array): An array of the order's line items.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API order response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#create-post_ecommerce_stores_store_id_orders
   */
  public function addOrder($store_id, $id, array $customer, array $order, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
    ];

    $parameters = [
      'id' => $id,
      'customer' => (object) $customer,
    ];

    $parameters += $order;

    return $this->request('POST', '/ecommerce/stores/{store_id}/orders', $tokens, $parameters, $batch);
  }

  /**
   * Update a specific order.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $order_id
   *   The ID for the order in the store.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API order response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#edit-patch_ecommerce_stores_store_id_orders_order_id
   */
  public function updateOrder($store_id, $order_id, $parameters = [], $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'order_id' => $order_id,
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/orders/{order_id}', $tokens, $parameters, $batch);
  }

  /**
   * Deletes an order.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $order_id
   *   The ID for the order in a store.
   *
   * @return object
   *   The API order response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/#delete-delete_ecommerce_stores_store_id_orders_order_id
   */
  public function deleteOrder($store_id, $order_id) {
    $tokens = [
      'store_id' => $store_id,
      'order_id' => $order_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/orders/{order_id}', $tokens);
  }

  /**
   * Get information about an order's line items.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $order_id
   *   The ID of the order.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API order line response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/lines/#read-get_ecommerce_stores_store_id_orders_order_id_lines
   */
  public function getOrderLines($store_id, $order_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'order_id' => $order_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/orders/{order_id}/lines', $tokens, $parameters);
  }

  /**
   * Get information about a specific order line item.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $order_id
   *   The ID of the order.
   * @param string $line_id
   *   The ID for the line item of an order.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API order line response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/lines/#read-get_ecommerce_stores_store_id_orders_order_id_lines_line_id
   */
  public function getOrderLine($store_id, $order_id, $line_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'order_id' => $order_id,
      'line_id' => $line_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/orders/{order_id}/lines/{line_id}', $tokens, $parameters);
  }

  /**
   * Add a new line item to an existing order.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $order_id
   *   The ID for the order in a store.
   * @param string $id
   *   A unique identifier for the order line item.
   * @param array $product
   *   Associative array of product information.
   *   - product_id (string) The unique identifier for the product.
   *   - product_variant_id (string) The unique id for the product variant.
   *   - quantity (int) The quantity of a cart line item.
   *   - price (float) The price of a cart line item.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API order line response object.
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/orders/lines/#create-post_ecommerce_stores_store_id_orders_order_id_lines
   */
  public function addOrderLine($store_id, $order_id, $id, $product, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'order_id' => $order_id,
    ];

    $parameters = [
      'id' => $id,
    ];

    $parameters += $product;

    return $this->request('POST', '/ecommerce/stores/{store_id}/orders/{order_id}/lines', $tokens, $parameters, $batch);
  }

  /**
   * Get information about all products for a store.
   *
   * @param string $store_id
   *   The store id.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API product response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/#read-get_ecommerce_stores_store_id_products
   */
  public function getProducts($store_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/products', $tokens, $parameters);
  }

  /**
   * Get information about a specific product.
   *
   * @param string $store_id
   *   The store id.
   * @param string $product_id
   *   The id for the product of a store.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API product response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/#read-get_ecommerce_stores_store_id_products_product_id
   */
  public function getProduct($store_id, $product_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/products/{product_id}', $tokens, $parameters);
  }

  /**
   * Add a product to a store.
   *
   * @param string $store_id
   *   The store id.
   * @param string $id
   *   A unique identifier for the product.
   * @param string $title
   *   The title of a product.
   * @param array $variants
   *   An array of the product’s variants.
   *   - id (string) A unique identifier for the product variant.
   *   - title (string) The title of a product variant.
   * @param array $parameters
   *   An array of additional parameters. See API docs.
   *
   * @return object
   *   The API Product response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/#create-post_ecommerce_stores_store_id_products
   */
  public function addProduct($store_id, $product_id, $title, $url, $variants = [], $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

    $parameters += [
      'id' => $product_id,
      'title' => $title,
      'url' => $url,
      'variants' => $variants,
    ];

    return $this->request('POST', '/ecommerce/stores/{store_id}/products', $tokens, $parameters);
  }

  /**
   * Update a product in a store.
   *
   * @param string $store_id
   *   The store id.
   * @param string $id
   *   A unique identifier for the product.
   * @param array $variants
   *   An array of the product's variants.
   *   - id (string) A unique identifier for the product variant.
   *   - title (string) The title of a product variant.
   * @param array $parameters
   *   An array of additional parameters. See API docs.
   *
   * @return object
   *   The API Product response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/#edit-patch_ecommerce_stores_store_id_products_product_id
   */
  public function updateProduct($store_id, $product_id, $variants = [], $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
    ];

    $parameters += [
      'variants' => $variants,
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/products/{product_id}', $tokens, $parameters);
  }

  /**
   * Delete a product.
   *
   * @param string $store_id
   *   The store id.
   * @param string $product_id
   *   The id for the product of the store.
   *
   * @return object
   *   The API product response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/#delete-delete_ecommerce_stores_store_id_products_product_id
   */
  public function deleteProduct($store_id, $product_id) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/products/{product_id}', $tokens);
  }

  /**
   * Add a variant to a product.
   *
   * @param string $store_id
   *   The store id.
   * @param string $product_id
   *   The id for the product of a store.
   * @param array $parameters
   *   Array of variant information.
   *
   * @return object
   *   The API product response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/variants/#create-post_ecommerce_stores_store_id_products_product_id_variants
   */
  public function addProductVariant($store_id, $product_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
    ];

    return $this->request('POST', '/ecommerce/stores/{store_id}/products/{product_id}/variants', $tokens, $parameters);
  }

  /**
   * Update a specific variant of a specific product.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $product_id
   *   The id for the product of a store.
   * @param string $variant_id
   *   The id for the product variant.
   * @param array $parameters
   *   The data to update the variant in an array.
   *
   * @return object
   *   The API product variant response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/variants/#edit-patch_ecommerce_stores_store_id_products_product_id_variants_variant_id
   */
  public function updateProductVariant($store_id, $product_id, $variant_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
      'variant_id' => $variant_id,
    ];
    return $this->request('PATCH', '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}', $tokens, $parameters);
  }

  /**
   * Get information about a specific variant of a specific product.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $product_id
   *   The id for the product of a store.
   * @param string $variant_id
   *   The id for the product variant.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API product variant response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/variants/#read-get_ecommerce_stores_store_id_products_product_id_variants_variant_id
   */
  public function getProductVariant($store_id, $product_id, $variant_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
      'variant_id' => $variant_id,
    ];
    return $this->request('GET', '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}', $tokens, $parameters);
  }

  /**
   * Get information on all variants of a specific product.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $product_id
   *   The product ID.
   *
   * @return object
   *   The API product variant response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/variants/#read-get_ecommerce_stores_store_id_products_product_id_variants
   */
  public function getProductVariants($store_id, $product_id) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
    ];
    return $this->request('GET', '/ecommerce/stores/{store_id}/products/{product_id}/variants', $tokens);
  }

  /**
   * Delete a specific variant of a specific product.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $product_id
   *   The product ID.
   * @param string $variant_id
   *   The variant ID.
   *
   * @return object
   *   The API product variant response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/products/variants/#delete-delete_ecommerce_stores_store_id_products_product_id_variants_variant_id
   */
  public function deleteProductVariant($store_id, $product_id, $variant_id) {
    $tokens = [
      'store_id' => $store_id,
      'product_id' => $product_id,
      'variant_id' => $variant_id,
    ];
    return $this->request('DELETE', '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}', $tokens);
  }

  /**
   * Get information about a store's promo rules.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API customer response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/#read-get_ecommerce_stores_store_id_promo_rules
   */
  public function getPromoRules($store_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/promo-rules', $tokens, $parameters);
  }

  /**
   * Get information about a promo rule.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $promo_rule_id
   *   The id for the promo rule of a store.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API promo rule response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/#read-get_ecommerce_stores_store_id_promo_rules_promo_rule_id
   */
  public function getPromoRule($store_id, $promo_rule_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
    ];
    return $this->request('GET', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}', $tokens, $parameters);
  }

  /**
   * Adds a new a promo rule to a store.
   *
   * @param string $store_id
   *   The store ID.
   * @param array $promo_rule
   *   An associative array of promo rule information.
   *   - id (string) A unique identifier for the promo rule.
   *   - description (string) A description of the promo rule
   *   - amount (number) The amount of the promo code discount.
   *       If ‘type’ is ‘fixed’, the amount is treated as a monetary value.
   *       If ‘type’ is ‘percentage’, amount must be a decimal value between
   *       0.0 and 1.0, inclusive.
   *   - type (string) Type of discount. For free shipping, set to fixed.
   *       Possible values: fixed, percentage
   *   - target (string) The target that the discount applies to. Possible
   *       values: per_item, total, shipping
   *
   * @return object
   *   The API promo rule response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/#create-post_ecommerce_stores_store_id_promo_rules
   */
  public function addPromoRule($store_id, $promo_rule) {
    $tokens = [
      'store_id' => $store_id,
    ];
    return $this->request('POST', '/ecommerce/stores/{store_id}/promo-rules', $tokens, $promo_rule);
  }

  /**
   * Update a promo rule.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $promo_rule
   *   An associative array of promo rule information.
   *   - id (string) A unique identifier for the promo rule.
   *   - description (string) A description of the promo rule
   *   - amount (number) The amount of the promo code discount.
   *       If ‘type’ is ‘fixed’, the amount is treated as a monetary value.
   *       If ‘type’ is ‘percentage’, amount must be a decimal value between
   *       0.0 and 1.0, inclusive.
   *   - type (string) Type of discount. For free shipping, set to fixed.
   *       Possible values: fixed, percentage
   *   - target (string) The target that the discount applies to. Possible
   *       values: per_item, total, shipping
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API promo rule response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/#edit-patch_ecommerce_stores_store_id_promo_rules_promo_rule_id
   */
  public function updatePromoRule($store_id, $promo_rule, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule['id'],
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}', $tokens, $promo_rule, $batch);
  }

  /**
   * Delete a promo rule.
   * @param string $store_id
   *   The ID of the store.
   * @param string $promo_rule_id
   *   The ID of the promo rule.
   *
   * @return object
   *   The API customer response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/#delete-delete_ecommerce_stores_store_id_promo_rules_promo_rule_id
   */
  public function deletePromoRule($store_id, $promo_rule_id) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}', $tokens);
  }

  /**
   * Get information about a store's promo codes.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   *   The API customer response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/promo-codes/#read-get_ecommerce_stores_store_id_promo_rules_promo_rule_id_promo_codes
   */
  public function getPromoCodes($store_id, $promo_rule_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
    ];

    return $this->request('GET', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes', $tokens, $parameters);
  }

  /**
   * Get information about a promo code.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $promo_rule_id
   *   The id for the promo rule of a store.
   * @param array $parameters
   *   An array of optional parameters. See API docs.
   *
   * @return object
   *   The API promo rule response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/promo-codes/#read-get_ecommerce_stores_store_id_promo_rules_promo_rule_id_promo_codes_promo_code_id
   */
  public function getPromoCode($store_id, $promo_rule_id, $promo_code_id, $parameters = []) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
      'promo_code_id' => $promo_code_id,
    ];
    return $this->request('GET', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes/{promo_code_id}', $tokens, $parameters);
  }

  /**
   * Adds a new a promo code to a store.
   *
   * @param string $store_id
   *   The store ID.
   * @param string $promo_rule_id
   *   The promo rule ID.
   * @param array $promo_code
   *   An associative array of promo code information.
   *   - id (string) A unique identifier for the promo code.
   *   - code (string) The discount code.
   *   - redemption_url (string) The url that should be used in the promotion
   *       campaign.
   *
   * @return object
   *   The API promo rule response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/promo-codes/#create-post_ecommerce_stores_store_id_promo_rules_promo_rule_id_promo_codes
   */
  public function addPromoCode($store_id, $promo_rule_id, $promo_code) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
    ];
    return $this->request('POST', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes', $tokens, $promo_code);
  }

  /**
   * Update a promo code.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $promo_rule_id
   *   The promo rule ID.
   * @param array $promo_code
   *   An associative array of promo code information.
   *   - id (string) A unique identifier for the promo code.
   *   - code (string) The discount code.
   *   - redemption_url (string) The url that should be used in the promotion
   *       campaign.
   * @param bool $batch
   *   TRUE to create a new pending batch operation.
   *
   * @return object
   *   The API promo rule response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/promo-codes/#edit-patch_ecommerce_stores_store_id_promo_rules_promo_rule_id_promo_codes_promo_code_id
   */
  public function updatePromoCode($store_id, $promo_rule_id, $promo_code, $batch = FALSE) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
      'promo_code_id' => $promo_code['id'],
    ];

    return $this->request('PATCH', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes/{promo_code_id}', $tokens, $promo_code, $batch);
  }

  /**
   * Delete a promo code.
   *
   * @param string $store_id
   *   The ID of the store.
   * @param string $promo_rule_id
   *   The ID of the promo rule.
   * @param string $promo_code_id
   *   The ID of the promo code.
   *
   * @return object
   *   The API customer response object.
   *
   * @throws \Mailchimp\MailchimpAPIException
   *
   * @see https://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/promo-rules/promo-codes/#delete-delete_ecommerce_stores_store_id_promo_rules_promo_rule_id_promo_codes_promo_code_id
   */
  public function deletePromoCode($store_id, $promo_rule_id, $promo_code_id) {
    $tokens = [
      'store_id' => $store_id,
      'promo_rule_id' => $promo_rule_id,
      'promo_code_id' => $promo_code_id,
    ];

    return $this->request('DELETE', '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes/{promo_code_id}', $tokens);
  }
}
