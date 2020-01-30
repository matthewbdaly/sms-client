<?php


namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Matthewbdaly\SMS\Contracts\Driver;

/**
 * Class O2SK
 * @documentation https://smstools.sk/downloads/SMSTOOLS-API-dokumentacia.pdf
 * @package Matthewbdaly\SMS\Drivers
 */
class O2SK implements Driver
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var string
     */
    private $endpoint;

    /**
     * O2SK constructor.
     * @param Client $client
     * @param array $config
     */
    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $config = array_merge([
            'apiKey'   => '',
            'endpoint' => 'https://api-tls12.smstools.sk/3/send_batch'
        ], $config);
        $this->apiKey = $config['apiKey'];
        $this->endpoint = $config['endpoint'];
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return 'O2SK';
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param array $message
     * @return bool
     * @throws \Matthewbdaly\SMS\Exceptions\ClientException
     * @throws \Matthewbdaly\SMS\Exceptions\ConnectException
     * @throws \Matthewbdaly\SMS\Exceptions\RequestException
     * @throws \Matthewbdaly\SMS\Exceptions\ServerException
     */
    public function sendRequest(array $message): bool
    {
        try {
            $payload = [
                'auth' => [
                    'apikey' => $this->apiKey
                ],
                'data' => $message
            ];

            $this->client->post($this->endpoint, [RequestOptions::JSON => $payload]);
        } catch (ClientException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ClientException();
        } catch (ServerException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ServerException();
        } catch (ConnectException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ConnectException();
        } catch (RequestException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\RequestException();
        }

        return true;
    }
}