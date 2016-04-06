<?php

namespace Mailchimp\Tests;

class Response extends \GuzzleHttp\Psr7\Response {

  public function getBody() {
    return '{}';
  }

}
