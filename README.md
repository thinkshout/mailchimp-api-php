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
