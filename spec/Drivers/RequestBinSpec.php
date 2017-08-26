<?php

namespace spec\Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Drivers\RequestBin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class RequestBinSpec extends ObjectBehavior
{
    function let(GuzzleClient $client, GuzzleResponse $response)
    {
        $config = [
            'path' => 'blah'
        ];
        $this->beConstructedWith($client, $response, $config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RequestBin::class);
    }

    function it_implements_interface()
    {
        $this->shouldImplement('Matthewbdaly\SMS\Contracts\Driver');
    }

    function it_returns_the_driver_name()
    {
        $this->getDriver()->shouldReturn('RequestBin');
    }

    function it_returns_the_driver_endpoint()
    {
        $this->getEndpoint()->shouldReturn('https://requestb.in/blah');
    }

    function it_sends_the_request()
    {
        $msg = [
            'to'      => '+44 01234 567890',
            'content' => 'Just testing',
        ];
        $this->sendRequest($msg)->shouldReturn(true);
    }
}
