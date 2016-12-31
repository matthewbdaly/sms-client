<?php

namespace Matthewbdaly\SMS;

use Matthewbdaly\SMS\Contracts\Driver;

class Client
{
    private $driver;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    public function getDriver()
    {
        return $this->driver->getDriver();
    }
}
