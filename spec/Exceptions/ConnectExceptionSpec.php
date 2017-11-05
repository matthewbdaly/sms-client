<?php

namespace spec\Matthewbdaly\SMS\Exceptions;

use Matthewbdaly\SMS\Exceptions\ConnectException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConnectExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ConnectException::class);
    }
}
