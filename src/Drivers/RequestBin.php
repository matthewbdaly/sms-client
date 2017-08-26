<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class RequestBin implements Driver
{
    protected $client;

    protected $response;

    private $path;

    public function __construct(GuzzleClient $client, GuzzleResponse $response, array $config)
    {
        $this->client = $client;
        $this->response = $response;
        $this->path = $config['path'];
    }

    public function getDriver()
    {
        return 'RequestBin';
    }

    public function getEndpoint()
    {
        return 'https://requestb.in/'.$this->path;
    }

    public function sendRequest(array $message)
    {
        // TODO: write logic here
    }
}
