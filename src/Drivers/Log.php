<?php

namespace Matthewbdaly\SMS\Drivers;

use Psr\Log\LoggerInterface;
use Matthewbdaly\SMS\Contracts\Driver;

class Log implements Driver
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getDriver(): string
    {
        return 'Log';
    }

    public function getEndpoint(): string
    {
        return '';
    }

    public function sendRequest(array $message): bool
    {
        $this->logger->info($message);
        return true;
    }
}
