<?php

namespace Mailchimp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Mailchimp {

  const DEFAULT_DATA_CENTER = 'us1';

  /**
   * @var string $endpoint
   *   The REST API endpoint.
   */
  private $endpoint = 'https://us1.api.mailchimp.com/3.0';

  /**
   * @var string $api_key
   *   The MailChimp API key to authenticate with.
   */
  private $api_key;

  /**
   * @var string $api_user
   *   The MailChimp API username to authenticate with.
   */
  private $api_user;

  /**
   * @var Client $client
   *   The GuzzleHttp Client.
   */
  private $client;

  /**
   * Mailchimp constructor.
   *
   * @param string $api_key
   *   The MailChimp API key.
   *
   * @param string $api_user
   *   The MailChimp API username.
   *
   * @param int $timeout
   *   Maximum request time in seconds.
   */
  public function __construct($api_key, $api_user = 'apikey', $timeout) {
    $this->api_key = $api_key;
    $this->api_user = $api_user;

    $dc = $this->getDataCenter($this->api_key);

    $this->endpoint = str_replace(Mailchimp::DEFAULT_DATA_CENTER, $dc, $this->endpoint);

    $this->client = new Client(array(
      'headers' => array(
        'Authorization' => $this->api_user . ' ' . $this->api_key,
      ),
      'timeout' => $timeout,
    ));
  }

  /**
   * Gets MailChimp account information for the authenticated account.
   */
  public function getAccount() {
    return $this->request('GET', '/');
  }

  /**
   * Makes a request to the MailChimp API.
   *
   * @param string $method
   *   The REST method to use when making the request.
   * @param string $path
   *   The API path to request.
   * @param array $tokens
   *   Associative array of tokens and values to replace in the path.
   *
   * @return object
   */
  private function request($method, $path, $tokens = NULL) {
    try {
      $response = $this->client->request($method, $this->endpoint . $path);

      $data = json_decode($response->getBody());

    } catch (RequestException $e) {
      $data = $e->getMessage();
    }

    return $data;
  }

  /**
   * Gets the ID of the data center associated with an API key.
   *
   * @param string $api_key
   *   The MailChimp API key.
   *
   * @return string
   *   The data center ID.
   */
  private function getDataCenter($api_key) {
    $dc = substr($api_key, -3);

    return (!empty($dc)) ? $dc : Mailchimp::DEFAULT_DATA_CENTER;
  }

}
