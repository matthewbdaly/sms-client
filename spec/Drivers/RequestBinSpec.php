<?php

namespace spec\Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Drivers\RequestBin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestBinSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RequestBin::class);
    }
}
