<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Matthewbdaly\SMS\Contracts\Driver;

/**
 * Null driver for testing
 */
class NullDriver implements Driver
{
    /**
     * Guzzle client
     *
     * @var $client
     */
    protected $client;

    /**
     * Guzzle response
     *
     * @var $response
     */
    protected $response;

    /**
     * Constructor
     *
     * @param GuzzleClient   $client   The Guzzle Client instance.
     * @param GuzzleResponse $response The Guzzle response instance.
     * @return void
     */
    public function __construct(GuzzleClient $client, GuzzleResponse $response)
    {
        $this->client = $client;
        $this->response = $response;
    }

    /**
     * Get driver name
     *
     * @return string
     */
    public function getDriver(): string
    {
        return 'Null';
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return '';
    }

    /**
     * Send the SMS
     *
     * @param array $message An array containing the message.
     * @return boolean
     */
    public function sendRequest(array $message): bool
    {
        return true;
    }
}
