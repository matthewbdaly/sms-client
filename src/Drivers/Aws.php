<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Driver;
use Aws\Sns\SnsClient;

/**
 * Driver for Nextmo.
 */
class Aws implements Driver
{
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
     * @param SnsClient|null    $sns    The Amazon SNS client.
     * @param array|null        $config The configuration array.
     *
     * @return void
     */
    public function __construct(SnsClient $sns = null, array $config = null)
    {
        if (!$sns) {
            $params = array(
                'credentials' => array(
                    'key' => $config['api_key'],
                    'secret' => $config['api_secret']
                ),
                'region' => $config['api_region'],
                'version' => 'latest'
            );
            $sns = new SnsClient($params);
        }
        $this->sns = $sns;
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
