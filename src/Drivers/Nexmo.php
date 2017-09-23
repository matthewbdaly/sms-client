<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Matthewbdaly\SMS\Contracts\Driver;

/**
 * Driver for Nextmo
 */
class Nexmo implements Driver
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
     * Endpoint
     *
     * @var $endpoint
     */
    private $endpoint = 'https://rest.nexmo.com/sms/json';

    /**
     * API Key
     *
     * @var $apiKey
     */
    private $apiKey;

    /**
     * API Secret
     *
     * @var $apiSecret
     */
    private $apiSecret;

    /**
     * Constructor
     *
     * @param GuzzleClient   $client   The Guzzle Client instance.
     * @param GuzzleResponse $response The Guzzle response instance.
     * @param array          $config   The configuration array.
     * @return void
     */
    public function __construct(GuzzleClient $client, GuzzleResponse $response, array $config)
    {
        $this->client = $client;
        $this->response = $response;
        $this->apiKey = $config['api_key'];
        $this->apiSecret = $config['api_secret'];
    }

    /**
     * Get driver name
     *
     * @return string
     */
    public function getDriver(): string
    {
        return 'Nexmo';
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Send the SMS
     *
     * @param array $message An array containing the message.
     * @return boolean
     * @throws \Matthewbdaly\SMS\Exceptions\ClientException Client exception.
     * @throws \Matthewbdaly\SMS\Exceptions\ServerException Server exception.
     * @throws \Matthewbdaly\SMS\Exceptions\NetworkException Network exception.
     * @throws \Matthewbdaly\SMS\Exceptions\ConnectException Connect exception.
     */
    public function sendRequest(array $message): bool
    {
        try {
            $message['api_key'] = $this->apiKey;
            $message['api_secret'] = $this->apiSecret;
            $message['text'] = $message['content'];
            unset($message['content']);
            $response = $this->client->request('POST', $this->getEndpoint().'?'.http_build_query($message));
        } catch (ClientException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ClientException();
        } catch (ServerException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ServerException();
        } catch (ConnectException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ConnectException();
        } catch (RequestException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\NetworkException();
        }

        return $response->getStatusCode() == 201;
    }
}
