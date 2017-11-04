<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Mailer;
use Matthewbdaly\SMS\Contracts\Driver;

class Mail implements Driver
{
    /**
     * Mailer.
     *
     * @var
     */
    protected $mailer;

    /**
     * Endpoint.
     *
     * @var
     */
    protected $endpoint;

    public function __construct(Mailer $mailer, array $config)
    {
        $this->mailer = $mailer;
        $this->endpoint = $config['domain'];
    }

    public function getDriver(): string
    {
        return 'Mail';
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Send the SMS.
     *
     * @param array $message An array containing the message.
     *
     * @return boolean
     */
    public function sendRequest(array $message): bool
    {
        return true;
    }
}
