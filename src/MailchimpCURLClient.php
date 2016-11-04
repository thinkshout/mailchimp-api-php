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

    // TODO: Set request headers.

    // Set requst content.
    switch ($method) {
      case 'POST':
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        break;
      case 'GET':
        $uri .= '?';

        // Concatenate parameters into request string.
        foreach ($parameters as $param_name => $param_value) {
          $uri .= $param_name . '=' . $param_value . '&';
        }

        // Remove last & character.
        $uri = substr($uri, 0, -1);
        break;
      case 'PUT':
        curl_setopt($ch, CURLOPT_PUT, TRUE);
        break;
      case 'PATCH':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        break;
      case 'DELETE':
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        break;
      default:
        // Throw exception for unsupported request type.
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
