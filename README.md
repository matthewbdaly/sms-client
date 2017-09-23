# sms-client
[![Build Status](https://travis-ci.org/matthewbdaly/sms-client.svg?branch=master)](https://travis-ci.org/matthewbdaly/sms-client)

A generic SMS client library. Supports multiple swappable drivers, so that you're never tied to just one provider.

This library is aimed squarely at sending SMS messages only, and I don't plan to add support for other functionality. The idea is to create one library that should be able to work with any provider that has a driver for the purpose of sending SMS messages.

Creating your own driver
------------------------

It's easy to create your own driver - just implement the `Matthewbdaly\SMS\Contracts\Driver` interface. You can use whatever method is most appropriate for sending the SMS - for instance, if your provider has a mail-to-SMS gateway, you can happily use Swiftmailer, or if they have a REST API you can use Guzzle.

You can pass any configuration options required in the `config` array in the constructor of the driver. Please ensure that your driver has tests using PHPSpec (see the existing drivers for examples), and that it meets the coding standard (the package includes a PHP Codesniffer configuration for that reason).
