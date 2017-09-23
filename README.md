# sms-client
[![Build Status](https://travis-ci.org/matthewbdaly/sms-client.svg?branch=master)](https://travis-ci.org/matthewbdaly/sms-client)

A generic SMS client library. Supports multiple swappable drivers.

Creating your own driver
------------------------

It's easy to create your own driver - just implement the `Matthewbdaly\SMS\Contracts\Driver` interface. You can use whatever method is most appropriate for sending the SMS - for instance, if your provider has a mail-to-SMS gateway, you can happily use Swiftmailer, or if they have a REST API you can use Guzzle.
