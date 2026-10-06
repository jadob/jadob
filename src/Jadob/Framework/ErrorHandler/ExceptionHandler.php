<?php
declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use ErrorException;
use Jadob\Framework\Event\ExceptionEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ExceptionHandler
{
    private ?EventDispatcherInterface $eventDispatcher = null;

    public function __construct(
        private ExceptionListenerInterface $fallbackListener
    ) {
    }

    public function setEventDispatcher(
        EventDispatcherInterface $eventDispatcher
    ): void {
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function registerErrorHandler(): void
    {
        set_error_handler($this->handleError(...));
    }

    public function handleError($errno, $errstr, $errfile, $errline): void
    {
        //@TODO: make deprecations visible in any way, shape, or form!
        if ($errno === E_DEPRECATED
            || $errno === E_USER_DEPRECATED) {
            return;
        }

        //According to documentation, it is intended to use error number as a severity
        //@see https://www.php.net/manual/en/errorexception.construct.php
        throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
    }

    public function registerExceptionHandler(): void
    {
        if (PHP_SAPI === 'cli') {
            return;
        }
        set_exception_handler($this->handleException(...));
    }

    public function handleException(Throwable $exception): Response
    {
        $event = new ExceptionEvent($exception);

        if ($this->eventDispatcher !== null) {
            $event = $this
                ->eventDispatcher
                ->dispatch($event);
        }

        if ($event->isPropagationStopped() === false) {
            $this
                ->fallbackListener
                ->handleExceptionEvent(
                    $event,
                );
        }
        
        return $event->getResponse();
    }
}