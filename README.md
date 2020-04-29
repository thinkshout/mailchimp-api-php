# PHP library for v3 of the Mailchimp API

This library provides convenient wrapper functions for Mailchimp's REST API.
The API is [documented here](http://developer.mailchimp.com/documentation/mailchimp/guides/get-started-with-mailchimp-api-3/).

## Requirements

- PHP 5.4.0 or greater (7.0 or greater if you wish to use phpunit)
- [Composer](https://getcomposer.org/)
- [Guzzle](https://github.com/guzzle/guzzle)

## Installation

Dependencies are managed by [Composer](https://getcomposer.org/). After
installing Composer, run the following command from the library root:

`composer install --no-dev --ignore-platform-reqs`

Or to install with phpunit:

`composer install`

## Usage

### Get your account information

A basic test to confirm the library is set up and functional.

```php
<?php
require 'PATH_TO_LIBRARY/mailchimp-api-php/vendor/autoload.php';
$api_key = 'YOUR_API_KEY';
$mailchimp = new Mailchimp\Mailchimp($api_key);

// Get the account details of the authenticated user.
$response = $mailchimp->getAccount();

// Output the account details.
if (!empty($response) && isset($response->account_id)) {
  echo "ID: {$response->account_id}\n"
  . "Name: {$response->account_name}\n";
}
```

### Get lists and their interest categories

A more complicated example that takes the response from one API call and
uses that data to make another.

```php
<?php
require 'PATH_TO_LIBRARY/mailchimp-api-php/vendor/autoload.php';
$api_key = 'YOUR_API_KEY';
$mailchimp_lists = new Mailchimp\MailchimpLists($api_key);

// Get all lists.
$response = $mailchimp_lists->getLists();

if (!empty($response) && isset($response->lists)) {
  foreach ($response->lists as $list) {
    // Output the list name.
    echo "List name: {$list->name}\n";

    // Get the list's interest categories.
    $interests = $mailchimp_lists->getInterestCategories($list->id);

    // Output the names of the list's interest categories.
    if (!empty($interests) && isset($interests->categories)) {
      foreach ($interests->categories as $category) {
        echo "Interest category: {$category->title}\n";
      }
    }
  }
}
```

## Testing

This library includes a [PHPUnit](https://phpunit.de/) test suite.

### Running PHPUnit tests

Add Composer's vendor directory to your PATH by adding the following line to
your profile. This is dependent on your system, but on a Linux or Mac OSX system
using Bash, you'll typically find the file at *~/.bash_profile*.

`export PATH="./vendor/bin:$PATH"`

Bash example:

```shell
echo 'export PATH="./vendor/bin:$PATH"' >> ~/.bash_profile
source ~/.bash_profile
```

Then run PHPUnit:

`phpunit`

### Mailchimp API Playground

Mailchimp's [API Playground](https://us1.api.mailchimp.com/playground/) provides
access to all API methods via a web-based UI. You can use this to test API calls
and review data you've sent to Mailchimp.
