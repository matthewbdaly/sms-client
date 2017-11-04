<?php

namespace Matthewbdaly\SMS\Contracts;

interface Mailer
{
    public function send(string $recipient, string $message);
}
