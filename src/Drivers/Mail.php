<?php

namespace Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Contracts\Mailer;

class Mail
{
    public function __construct($argument1)
    {
        // TODO: write logic here
    }

    public function getDriver()
    {
        return 'Mail';
    }

    public function getEndpoint()
    {
        return '';
    }
}
