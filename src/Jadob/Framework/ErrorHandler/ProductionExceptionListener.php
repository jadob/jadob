<?php

declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use Jadob\Framework\Event\ExceptionEvent;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductionExceptionListener implements ExceptionListenerInterface, LoggerAwareInterface
{
    private ?LoggerInterface $logger = null;

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function handleExceptionEvent(ExceptionEvent $event): void
    {
        $event->setResponse(new Response(status: Response::HTTP_INTERNAL_SERVER_ERROR));
        $event->stopPropagation();

        $this->logger?->critical(
            $event->getException(),
            $event->getException()->getTrace()
        );
    }
}