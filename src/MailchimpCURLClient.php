<?php

namespace Mailchimp;

/**
 *
 * @package Mailchimp
 */
class MailchimpCURLClient {

  private $config;

  public function __construct($config = []) {
    $this->config = $config;
  }

  public function request($method, $uri = '', $options = [], $parameters = []) {
    $ch = curl_init();

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
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
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
        break;
    }

    curl_setopt($ch, CURLOPT_URL, $uri);

    // Get response as a string.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
  }

}
