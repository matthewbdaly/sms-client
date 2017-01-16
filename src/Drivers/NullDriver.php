<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;

class NullDriver implements Driver
{
    public function getDriver()
    {
    }

    public function getEndpoint()
    {
    }

    public function sendRequest(array $message)
    {
    }
}
