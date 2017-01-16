<?php

namespace spec\Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Drivers\NullDriver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NullDriverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NullDriver::class);
    }

    function it_implements_interface()
    {
        $this->shouldImplement('Matthewbdaly\SMS\Contracts\Driver');
    }
}
