<?php

namespace Matthewbdaly\SMS\Contracts;

interface Driver
{
    public function getDriver();

    public function getEndpoint();

    public function sendRequest(array $message);
}
