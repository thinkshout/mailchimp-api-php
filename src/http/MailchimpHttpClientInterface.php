<?php

namespace Mailchimp\http;

/**
 * Interface for all HTTP clients used with the Mailchimp library.
 *
 * @package Mailchimp
 */
interface MailchimpHttpClientInterface {

  /**
   * Makes a request to the Mailchimp API.
   *
   * @param string $method
   *   The REST method to use when making the request.
   * @param string $uri
   *   The API URI to request.
   * @param array $options
   *   Request options. @see Mailchimp::request().
   * @param array $parameters
   *   Associative array of parameters to send in the request body.
   * @param bool $returnAssoc
   *   TRUE to return Mailchimp API response as an associative array.
   *
   * @return object
   *
   * @throws \Exception
   */
  public function handleRequest($method, $uri = '', $options = [], $parameters = [], $returnAssoc = FALSE);

}
