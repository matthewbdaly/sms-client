<?php

namespace spec\Matthewbdaly\SMS\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;
use Matthewbdaly\SMS\Drivers\RequestBin;
use PhpSpec\ObjectBehavior;

class RequestBinSpec extends ObjectBehavior
{
    public function let(GuzzleClient $client, ResponseInterface $response)
    {
        $config = [
            'path' => 'blah',
        ];
        $this->beConstructedWith($client, $response, $config);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RequestBin::class);
    }

    public function it_implements_interface()
    {
        $this->shouldImplement('Matthewbdaly\SMS\Contracts\Driver');
    }

    public function it_returns_the_driver_name()
    {
        $this->getDriver()->shouldReturn('RequestBin');
    }

    public function it_returns_the_driver_endpoint()
    {
        $this->getEndpoint()->shouldReturn('https://requestb.in/blah');
    }

    public function it_sends_the_request(ResponseInterface $response)
    {
        $msg = [
            'to'      => '+44 01234 567890',
            'content' => 'Just testing',
        ];
        $mock = new MockHandler(
            [
            new GuzzleResponse(201),
            ]
        );
        $handler = HandlerStack::create($mock);
        $client = new GuzzleClient(['handler' => $handler]);
        $config = [
            'path' => 'blah',
        ];
        $this->beConstructedWith($client, $response, $config);
        $this->sendRequest($msg)->shouldReturn(true);
    }
}
