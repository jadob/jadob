<?php
declare(strict_types=1);

namespace Jadob\Core\Tests\Event;


use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Core\RequestContext;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BeforeControllerEventTest extends TestCase
{

    public function testReturnsRequestPassedToContext()
    {
        $request = Request::createFromGlobals();
        $context = new RequestContext('x', $request, false);

        $event = new BeforeControllerEvent($context);
        $this->assertSame($request, $event->getRequest());
        $this->assertSame($context, $event->getContext());

    }

    public function testPassingResponseWillCauseEventWillStopPropagation()
    {
        $request = Request::createFromGlobals();
        $context = new RequestContext('d', $request, false);

        $event = new BeforeControllerEvent($context);

        $this->assertFalse($event->isPropagationStopped());
        $event->setResponse(new Response());
        $this->assertTrue($event->isPropagationStopped());

    }
}