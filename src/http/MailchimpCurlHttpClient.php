<?php

namespace Mailchimp\http;

/**
 * An HTTP client for use with the MailChimp API using cURL.
 *
 * @package Mailchimp
 */
class MailchimpCurlHttpClient implements MailchimpHttpClientInterface {

  /**
   * @inheritdoc
   */
  public function handleRequest($method, $uri = '', $options = [], $parameters = [], $returnAssoc = FALSE) {
    // TODO: Handle HTTP request via cURL.
  }

}
