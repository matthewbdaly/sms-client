<?php

namespace Matthewbdaly\SMS\Drivers;

use GuzzleHttp\ClientInterface as GuzzleClient;
use Psr\Http\Message\ResponseInterface;
use Matthewbdaly\SMS\Contracts\Driver;

/**
 * Driver for Nextmo.
 */
class Aws implements Driver
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
    private $endpoint = '';

    /**
     * SNS Client
     *
     * @var
     */
     protected $sns;

    /**
     * Constructor.
     *
     * @param GuzzleClient      $client   The Guzzle Client instance.
     * @param ResponseInterface $response The response instance.
     * @param array             $config   The configuration array.
     *
     * @return void
     */
    public function __construct(GuzzleClient $client, ResponseInterface $response, array $config)
    {
        $params = array(
            'credentials' => array(
                'key' => $config['api_key'],
                'secret' => $config['api_secret']
            ),
            'region' => $config['api_region'],
            'version' => 'latest'
        );
        $this->sns = new \Aws\Sns\SnsClient($params);

    }

    /**
     * Get driver name.
     *
     * @return string
     */
    public function getDriver(): string
    {
        return 'Aws';
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
            $args = array(
                "SenderID" => $message['from'],
                "SMSType" => "Transactional",
                "Message" => $message['content'],
                "PhoneNumber" => $message['to']
            );
            
            $result = $this->sns->publish($args);

        } catch (\Aws\Sns\Exception\SnsException $e) {
            throw new \Matthewbdaly\SMS\Exceptions\ClientException();
        }

        return true;
    }
}
