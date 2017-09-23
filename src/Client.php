<?php

namespace Matthewbdaly\SMS;

use Matthewbdaly\SMS\Contracts\Driver;

/**
 * SMS client.
 */
class Client
{
    /**
     * Driver to use.
     *
     * @var
     */
    private $driver;

    /**
     * Constructor.
     *
     * @param Driver $driver The driver to use.
     *
     * @return void
     */
    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Get the driver name.
     *
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver->getDriver();
    }

    /**
     * Send the message.
     *
     * @param array $msg The message array.
     *
     * @return boolean
     */
    public function send(array $msg): bool
    {
        return $this->driver->sendRequest($msg);
    }
}
