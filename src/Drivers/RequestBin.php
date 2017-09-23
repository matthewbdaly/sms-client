<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;

class RequestBin implements Driver
{
    protected $client;

    protected $response;

    private $path;

    private $endpoint = 'https://requestb.in/';

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
        return $this->endpoint.$this->path;
    }

    public function sendRequest(array $message)
    {
        try {
            $response = $this->client->request('POST', $this->getEndpoint(), $message);
        } catch (ClientException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ClientException;
        } catch (ServerException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ServerException;
        } catch (ConnectException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ConnectException;
        } catch (RequestException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\NetworkException;
        }
        return $response->getStatusCode() == 201;
    }
}
