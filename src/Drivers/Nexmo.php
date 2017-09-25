<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;
use Matthewbdaly\SMS\Contracts\Driver;

/**
 * Driver for Nextmo.
 */
class Nexmo implements Driver
{
    /**
     * Guzzle client.
     *
     * @var
     */
    protected $client;

    /**
     * Guzzle response.
     *
     * @var
     */
    protected $response;

    /**
     * Endpoint.
     *
     * @var
     */
    private $endpoint = 'https://rest.nexmo.com/sms/json';

    /**
     * API Key.
     *
     * @var
     */
    private $apiKey;

    /**
     * API Secret.
     *
     * @var
     */
    private $apiSecret;

    /**
     * Constructor.
     *
     * @param GuzzleClient   $client   The Guzzle Client instance.
     * @param ResponseInterface $response The response instance.
     * @param array          $config   The configuration array.
     *
     * @return void
     */
    public function __construct(GuzzleClient $client, ResponseInterface $response, array $config)
    {
        $this->client = $client;
        $this->response = $response;
        $this->apiKey = $config['api_key'];
        $this->apiSecret = $config['api_secret'];
    }

    /**
     * Get driver name.
     *
     * @return string
     */
    public function getDriver(): string
    {
        return 'Nexmo';
    }

    /**
     * Get endpoint URL.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Send the SMS.
     *
     * @param array $message An array containing the message.
     *
     * @throws \Matthewbdaly\SMS\Exceptions\ClientException  Client exception.
     * @throws \Matthewbdaly\SMS\Exceptions\ServerException  Server exception.
     * @throws \Matthewbdaly\SMS\Exceptions\NetworkException Network exception.
     * @throws \Matthewbdaly\SMS\Exceptions\ConnectException Connect exception.
     *
     * @return boolean
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
