<?php

namespace Mailchimp;

use Mailchimp\http\MailchimpHttpClientInterface;

/**
 * Defines an interface for a Mailchimp API object.
 *
 * @internal
 */
interface MailchimpApiInterface {

  /**
   * Makes a request to the Mailchimp API.
   *
   * @param string $method
   *   The REST method to use when making the request.
   * @param string $path
   *   The API path to request.
   * @param array $tokens
   *   Associative array of tokens and values to replace in the path.
   * @param array $parameters
   *   Associative array of parameters to send in the request body.
   * @param bool $batch
   *   TRUE if this request should be added to pending batch operations.
   * @param bool $returnAssoc
   *   TRUE to return Mailchimp API response as an associative array.
   *
   * @return mixed
   *   Object or Array if $returnAssoc is TRUE.
   *
   * @throws MailchimpAPIException
   */
  public function request($method, $path, $tokens = NULL, $parameters = [], $batch = FALSE, $returnAssoc = FALSE);


}
