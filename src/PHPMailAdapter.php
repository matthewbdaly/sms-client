<?php

namespace Matthewbdaly\SMS;

use Matthewbdaly\SMS\Contracts\Mailer;

class PHPMailAdapter implements Mailer
{
    public function send(string $recipient, string $message)
    {
        mail($recipient, "", $message);
    }
}
