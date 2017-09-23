<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Matthewbdaly\SMS\Contracts\Driver;

class NullDriver implements Driver
{
    protected $client;

    protected $response;

    public function __construct(GuzzleClient $client, GuzzleResponse $response)
    {
        $this->client = $client;
        $this->response = $response;
    }

    public function getDriver(): string
    {
        return 'Null';
    }

    public function getEndpoint()
    {
    }

    public function sendRequest(array $message): bool
    {
        return true;
    }
}
