<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Mailer;
use Matthewbdaly\SMS\Contracts\Driver;

class Mail implements Driver
{
    public function __construct($argument1)
    {
        // TODO: write logic here
    }

    public function getDriver(): string
    {
        return 'Mail';
    }

    public function getEndpoint(): string
    {
        return '';
    }
}
