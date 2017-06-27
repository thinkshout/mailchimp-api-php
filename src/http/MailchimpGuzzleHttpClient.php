<?php

namespace Mailchimp\http;

/**
 * An HTTP client for use with the MailChimp API using Guzzle.
 *
 * @package Mailchimp
 */
class MailchimpGuzzleHttpClient implements MailchimpHttpClientInterface {

  /**
   * @inheritdoc
   */
  public function handleRequest($method, $uri = '', $options = [], $parameters = [], $returnAssoc = FALSE) {
    // TODO: Handle HTTP request via Guzzle.
  }

}
