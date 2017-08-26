<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class RequestBin implements Driver
{
    protected $client;

    protected $response;

    public function __construct(GuzzleClient $client, GuzzleResponse $response)
    {
        $this->client = $client;
        $this->response = $response;
    }

    public function getDriver()
    {
        // TODO: write logic here
    }

    public function getEndpoint()
    {
        // TODO: write logic here
    }

    public function sendRequest($argument1)
    {
        // TODO: write logic here
    }
}
