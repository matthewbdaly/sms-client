<?php

namespace spec\Matthewbdaly\SMS\Drivers;

use Matthewbdaly\SMS\Drivers\Mail;
use Matthewbdaly\SMS\Contracts\Mailer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailSpec extends ObjectBehavior
{
    public function let(Mailer $mailer)
    {
        $this->beConstructedWith($mailer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Mail::class);
    }

    public function it_implements_interface()
    {
        $this->shouldImplement('Matthewbdaly\SMS\Contracts\Driver');
    }

    public function it_returns_the_driver_name()
    {
        $this->getDriver()->shouldReturn('Mail');
    }

    public function it_returns_the_driver_endpoint()
    {
        $this->getEndpoint()->shouldReturn('');
    }

    public function it_sends_the_request(Mailer $mailer)
    {
        $msg = [
            'to'      => '+44 01234 567890',
            'content' => 'Just testing',
        ];
        $this->beConstructedWith($mailer, $config);
        $this->sendRequest($msg)->shouldReturn(true);
    }
}
