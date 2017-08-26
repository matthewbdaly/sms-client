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
        return 'RequestBin';
    }

    public function getEndpoint()
    {
        return 'https://requestb.in/';
    }

    public function sendRequest(array $message)
    {
        // TODO: write logic here
    }
}
