<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

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
        return null;
    }

    public function sendRequest(array $message): bool
    {
        return true;
    }
}
