<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Matthewbdaly\SMS\Contracts\Driver;

class Nexmo implements Driver
{
    protected $client;

    protected $response;

    private $endpoint = 'https://rest.nexmo.com/sms/json';

    private $apiKey;

    private $apiSecret;

    public function __construct(GuzzleClient $client, GuzzleResponse $response, array $config)
    {
        $this->client = $client;
        $this->response = $response;
        $this->apiKey = $config['api_key'];
        $this->apiSecret = $config['api_secret'];
    }

    public function getDriver()
    {
        return 'Nexmo';
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function sendRequest(array $message): bool
    {
        try {
            $message['api_key'] = $this->apiKey;
            $message['api_secret'] = $this->apiSecret;
            $message['text'] = $message['content'];
            unset($message['content']);
            $response = $this->client->request('POST', $this->getEndpoint(), $message);
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
