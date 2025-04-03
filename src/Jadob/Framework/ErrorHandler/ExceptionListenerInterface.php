<?php

declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use Jadob\Framework\Event\ExceptionEvent;

interface ExceptionListenerInterface
{
    public function handleExceptionEvent(
        ExceptionEvent $event
    ): void;
}