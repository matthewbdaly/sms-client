<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;

class Clockwork implements Driver
{
    private $endpoint = 'https://api.clockworksms.com/http/send.aspx';

    public function getDriver()
    {
        return 'Clockwork';
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function sendRequest(array $message): bool
    {
        return true;
    }
}
