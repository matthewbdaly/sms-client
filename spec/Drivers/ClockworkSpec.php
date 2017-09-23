<?php

namespace spec\Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Matthewbdaly\SMS\Drivers\Clockwork;
use PhpSpec\ObjectBehavior;

class ClockworkSpec extends ObjectBehavior
{
    public function let(GuzzleClient $client, GuzzleResponse $response)
    {
        $config = [
            'api_key' => 'blah',
        ];
        $this->beConstructedWith($client, $response, $config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Clockwork::class);
    }

    public function it_implements_interface()
    {
        $this->shouldImplement('Matthewbdaly\SMS\Contracts\Driver');
    }

    public function it_returns_the_driver_name()
    {
        $this->getDriver()->shouldReturn('Clockwork');
    }

    public function it_returns_the_driver_endpoint()
    {
        $this->getEndpoint()->shouldReturn('https://api.clockworksms.com/http/send.aspx');
    }

    public function it_sends_the_request()
    {
        $msg = [
            'to'      => '+44 01234 567890',
            'content' => 'Just testing',
        ];
        $this->sendRequest($msg)->shouldReturn(true);
    }
}
