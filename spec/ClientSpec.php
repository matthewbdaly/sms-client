<?php

namespace spec\Matthewbdaly\SMS;

use Matthewbdaly\SMS\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }
}
