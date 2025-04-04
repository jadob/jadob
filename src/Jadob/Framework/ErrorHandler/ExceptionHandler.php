<?php
declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use ErrorException;
use Jadob\Framework\Event\ExceptionEvent;
use Throwable;

readonly class ExceptionHandler
{
    public function __construct(
        private ExceptionListenerInterface $fallbackListener
    ) {
    }

    public function registerErrorHandler(): void
    {
        set_error_handler($this->handleError(...));
    }

    public function handleError($errno, $errstr, $errfile, $errline): void
    {
        //According to documentation, it is intended to use error number as a severity
        //@see https://www.php.net/manual/en/errorexception.construct.php
        throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
    }

    public function registerExceptionHandler(): void
    {
        set_exception_handler($this->handleException(...));
    }

    public function handleException(Throwable $exception): void
    {
        $this->fallbackListener->handleExceptionEvent(
            new ExceptionEvent($exception)
        );
    }
}