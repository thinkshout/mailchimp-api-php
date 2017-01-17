<?php

namespace Mailchimp;

/**
 * cURL client configured for use with the MailChimp API.
 *
 * @package Mailchimp
 */
class MailchimpCURLClient {

  private $config;

  /**
   * MailchimpCURLClient constructor.
   *
   * @param array $config
   *   cURL configuration options.
   *   Currently supports only 'timeout'.
   */
  public function __construct($config = []) {
    $this->config = $config;
  }

  /**
   * Makes a request to the MailChimp API using cURL.
   *
   * @param string $method
   *   The REST method to use when making the request.
   * @param string $uri
   *   The API URI to request.
   * @param array $options
   *   Request options. @see Mailchimp::request().
   * @param array $parameters
   *   Associative array of parameters to send in the request body.
   *
   * @return object
   *
   * @throws \Exception
   */
  public function request($method, $uri = '', $options = [], $parameters = []) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_TIMEOUT, $this->config['timeout']);

    // Set request headers.
    $headers = [];
    foreach ($options['headers'] as $header_name => $header_value) {
      $headers[] = $header_name . ': ' . $header_value;
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Set request content.
    switch ($method) {
      case 'POST':
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode((object) $parameters));
        break;

      case 'GET':
        $uri .= '?' . http_build_query($parameters);
        break;

      case 'PUT':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode((object) $parameters));
        break;

      case 'PATCH':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode((object) $parameters));
        break;

      case 'DELETE':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        break;

      default:
        // Throw exception for unsupported request method.
        throw new \Exception('Unsupported HTTP request method: ' . $method);
    }

    curl_setopt($ch, CURLOPT_URL, $uri);

    // Get response as a string.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);

    $http_code = 0;
    $error = NULL;

    // curl_errno return a code which tell us how the curl request happened.
    // It's not related with the http result. So we need to check this before
    // testing the actual http result.
    if (curl_errno($ch)) {
      // Handle errors.
      $error = curl_error($ch);
    }
    else {
      // The http request was ok, so we can now test the HTTP status code.
      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      if ($http_code != 200) {
        $response_data = json_decode($response);
        $error = $response_data->detail;
      }
    }

    // Close cURL connection.
    curl_close($ch);

    if (!empty($error)) {
      throw new \Exception($error, $http_code);
    }

    return $response;
  }

}
