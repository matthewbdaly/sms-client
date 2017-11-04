<?php

namespace Matthewbdaly\SMS\Drivers;

class Mail
{
    public function getDriver()
    {
        return 'Mail';
    }

    public function getEndpoint()
    {
        return '';
    }
}
