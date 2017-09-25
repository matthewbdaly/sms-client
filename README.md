# sms-client
[![Build Status](https://travis-ci.org/matthewbdaly/sms-client.svg?branch=master)](https://travis-ci.org/matthewbdaly/sms-client)

A generic SMS client library. Supports multiple swappable drivers, so that you're never tied to just one provider.

This library is aimed squarely at sending SMS messages only, and I don't plan to add support for other functionality. The idea is to create one library that should be able to work with any provider that has a driver for the purpose of sending SMS messages.

Drivers
-------

It currently ships with the following drivers:

* Clockwork
* Nexmo

In addition, it also has the following drivers for test purposes:

* RequestBin
* Null
* Log

The RequestBin sends the POST request to the specified RequestBin path for debugging. The Null driver does nothing, while the Log driver accepts a PSR3 logger and uses it to log the request.

Example Usage
-----

**Null**

```php
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Matthewbdaly\SMS\Drivers\Null;
use Matthewbdaly\SMS\Client;

$guzzle = new GuzzleClient;
$resp = new Response;
$driver = new Null($guzzle, $resp);
$client = new Client($driver);
$msg = [
    'to'      => '+44 01234 567890',
    'content' => 'Just testing',
];
$client->send($msg);
```

**Log**

```php
use Matthewbdaly\SMS\Drivers\Log;
use Matthewbdaly\SMS\Client;
use Psr\Log\LoggerInterface;

$driver = new Log($logger); // $logger should be an implementation of Psr\Log\LoggerInterface
$client = new Client($driver);
$msg = [
    'to'      => '+44 01234 567890',
    'content' => 'Just testing',
];
$client->send($msg);

```

**RequestBin**

```php
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Matthewbdaly\SMS\Drivers\RequestBin;
use Matthewbdaly\SMS\Client;

$guzzle = new GuzzleClient;
$resp = new Response;
$driver = new RequestBin($guzzle, $resp, [
    'path' => 'MY_REQUESTBIN_PATH',
]);
$client = new Client($driver);
$msg = [
    'to'      => '+44 01234 567890',
    'content' => 'Just testing',
];
$client->send($msg);
```

**Clockwork**

```php
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Matthewbdaly\SMS\Drivers\Clockwork;
use Matthewbdaly\SMS\Client;

$guzzle = new GuzzleClient;
$resp = new Response;
$driver = new Clockwork($guzzle, $resp, [
    'api_key' => 'MY_CLOCKWORK_API_KEY',
]);
$client = new Client($driver);
$msg = [
    'to'      => '+44 01234 567890',
    'content' => 'Just testing',
];
$client->send($msg);
```

**Nexmo**

```php
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Matthewbdaly\SMS\Drivers\Nexmo;
use Matthewbdaly\SMS\Client;

$guzzle = new GuzzleClient;
$resp = new Response;
$driver = new Nexmo($guzzle, $resp, [
    'api_key' => 'MY_NEXMO_API_KEY',
    'api_secret' => 'MY_NEXMO_API_SECRET',
]);
$client = new Client($driver);
$msg = [
    'to'      => '+44 01234 567890',
    'from'    => 'Test User',
    'content' => 'Just testing',
];
$client->send($msg);
```

Creating your own driver
------------------------

It's easy to create your own driver - just implement the `Matthewbdaly\SMS\Contracts\Driver` interface. You can use whatever method is most appropriate for sending the SMS - for instance, if your provider has a mail-to-SMS gateway, you can happily use Swiftmailer, or if they have a REST API you can use Guzzle.

You can pass any configuration options required in the `config` array in the constructor of the driver. Please ensure that your driver has tests using PHPSpec (see the existing drivers for examples), and that it meets the coding standard (the package includes a PHP Codesniffer configuration for that reason).

If you've created a new driver, feel free to submit a pull request and I'll consider including it.

Laravel integration
-------------------

Using Laravel? You probably want to use [my integration package](https://packagist.org/packages/matthewbdaly/laravel-sms) rather than this one, since that includes a service provider, as well as the `SMS` facade and easier configuration.
