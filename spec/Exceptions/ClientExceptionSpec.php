<?php

namespace spec\Matthewbdaly\SMS\Exceptions;

use Matthewbdaly\SMS\Exceptions\ClientException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ClientException::class);
    }
}
