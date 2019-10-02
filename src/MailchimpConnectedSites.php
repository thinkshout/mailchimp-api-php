<?php

namespace Mailchimp;

/**
 * Mailchimp Connected Sites library.
 *
 * @package Mailchimp
 *
 * @see https://kb.mailchimp.com/integrations/connected-sites/about-connected-sites
 */
class MailchimpConnectedSites extends Mailchimp {

  /**
   * Gets information about all connected sites for the authenticated account.
   *
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   */
  public function getConnectedSites($parameters = []) {
    return $this->request('GET', '/connected-sites', NULL, $parameters);
  }

  /**
   * Gets a connected site.
   *
   * @param string $connected_site_id
   *   The ID of the connected site.
   * @param array $parameters
   *   Associative array of optional request parameters.
   *
   * @return object
   */
  public function getConnectedSite($connected_site_id, $parameters = []) {
    $tokens = [
      'connected_site_id' => $connected_site_id,
    ];

    return $this->request('GET', '/connected-sites/{connected_site_id}', $tokens, $parameters);
  }

}
