<?php

declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use Jadob\Framework\Event\ExceptionEvent;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class ProductionExceptionListener implements ExceptionListenerInterface, LoggerAwareInterface
{
    public function setLogger(LoggerInterface $logger)
    {
        dd($logger);
    }

    public function handleExceptionEvent(ExceptionEvent $event): void
    {
        dd($event);
    }
}