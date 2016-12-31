<?php

namespace spec\Matthewbdaly\SMS;

use Matthewbdaly\SMS\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Matthewbdaly\SMS\Contracts\Driver;

class ClientSpec extends ObjectBehavior
{
    function let(Driver $driver)
    {
        $this->beConstructedWith($driver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }
}
