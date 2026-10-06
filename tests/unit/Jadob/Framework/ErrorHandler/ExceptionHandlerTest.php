<?php

declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use Jadob\Framework\Event\ExceptionEvent;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class ExceptionHandlerTest extends TestCase
{

    public function testEventDispatcherWillBeInvokedOnExceptionEventWhenPresent(): void
    {
        $handler = new ExceptionHandler(
            fallbackListener: $this->createStub(ExceptionListenerInterface::class)
        );

        $eventDispatcherMock = $this->createMock(EventDispatcherInterface::class);

        $exceptionEvent = new ExceptionEvent(new \Exception());
        $exceptionEvent->setResponse(new Response());
        $exceptionEvent->stopPropagation();
        $eventDispatcherMock
            ->expects(self::once())
            ->method('dispatch')
            ->willReturn($exceptionEvent);

        $handler->setEventDispatcher($eventDispatcherMock);

        $handler->handleException(
            new \Exception('original')
        );

    }

}