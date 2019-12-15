<?php

namespace Jadob\Debug\ErrorHandler;

use Psr\Log\LoggerInterface;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ProductionErrorHandler implements ErrorHandlerInterface
{

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function registerErrorHandler()
    {
        $logger = $this->logger;

        if (PHP_SAPI !== 'cli') {
            set_error_handler(
                static function ($errno, $errstr, $errfile, $errline) use ($logger) {
                    if ($errno === E_USER_DEPRECATED || $errno === E_DEPRECATED) {
                        $message = 'Deprecated: ' . $errstr;

                        /** @noinspection NotOptimalIfConditionsInspection */
                        if ($errno === E_USER_DEPRECATED) {
                            $message = 'User Deprecated: ' . $errstr;
                        }
                        $context['file'] = $errfile;
                        $context['line'] = $errline;
                        $context['stacktrace'] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
                        $logger->warning($message, $context);
                        return;
                    }

                    //According to documentation, it is intended to use error number as a severity
                    //@see https://www.php.net/manual/en/errorexception.construct.php
                    throw new \ErrorException($errstr, $errno, $errno, $errfile, $errline);
                }
            );
        }
    }


    public function registerExceptionHandler()
    {
        $logger = $this->logger;
        if (PHP_SAPI !== 'cli') {
            set_exception_handler(
                static function (\Throwable $exception) use ($logger) {
                    \http_response_code(500);

                    $logger->critical(
                        $exception->getMessage(), [
                            'file' => $exception->getFile(),
                            'line' => $exception->getLine(),
                            'trace' => $exception->getTrace(),
                            'type' => get_class($exception)
                        ]
                    );

                    exit;

                }
            );
        }
    }
}