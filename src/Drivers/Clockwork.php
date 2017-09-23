<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Matthewbdaly\SMS\Contracts\Driver;

class Clockwork implements Driver
{
    protected $client;

    protected $response;

    private $endpoint = 'https://api.clockworksms.com/http/send.aspx';

    private $apiKey;

    public function __construct(GuzzleClient $client, GuzzleResponse $response, array $config)
    {
        $this->client = $client;
        $this->response = $response;
        $this->apiKey = $config['api_key'];
    }

    public function getDriver()
    {
        return 'Clockwork';
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function sendRequest(array $message): bool
    {
        try {
            $message['key'] = $this->apiKey;
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
