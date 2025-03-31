<?php

declare(strict_types=1);

namespace Jadob\Debug\ErrorHandler;

use ErrorException;
use Jadob\Contracts\ErrorHandler\ErrorHandlerInterface;
use Psr\Log\LoggerInterface;
use Throwable;
use function debug_backtrace;
use function error_log;
use function get_class;
use function htmlspecialchars;
use function http_response_code;
use function implode;
use function is_array;
use function is_object;
use function is_resource;
use function is_scalar;
use function set_error_handler;
use function set_exception_handler;
use const DEBUG_BACKTRACE_IGNORE_ARGS;
use const E_DEPRECATED;
use const E_USER_DEPRECATED;
use const PHP_SAPI;

/**
 * TODO Separate logger for deprecations?
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DevelopmentErrorHandler implements ErrorHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * DevelopmentErrorHandler constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return void
     */
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
                    throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
                }
            );
        }
    }

    /**
     * @return void
     */
    public function registerExceptionHandler()
    {
        $logger = $this->logger;
        if (PHP_SAPI !== 'cli') {
            set_exception_handler(
                static function (Throwable $exception) use ($logger) {
                    http_response_code(500);
                    error_log(get_class($exception) . ': ' . $exception->getMessage());
                    error_log('Stack Trace: ');
                    error_log($exception->getTraceAsString());

                    $logger->critical(
                        $exception->getMessage(), [
                            'file' => $exception->getFile(),
                            'line' => $exception->getLine(),
                            'trace' => $exception->getTrace(),
                            'type' => get_class($exception)
                        ]
                    );
                    include __DIR__ . '/../templates/error_view.php';
                }
            );
        }
    }


    /**
     * TODO Move to another class
     * @param $variable
     * @return string
     */
    public static function getVariableType($variable)
    {
        if ($variable === null) {
            return 'null';
        }
        if (is_string($variable)) {
            if (strlen($variable) === 0) {
                return '""';
            }

            return $variable;
        }
        if (is_scalar($variable)) {
            return 'scalar';
        }
        if (is_object($variable)) {
            return get_class($variable);
        }
        if (is_array($variable)) {
            return 'array';
        }
        if (is_resource($variable)) {
            return 'resource';
        }
        return 'unknown';
    }

    /**
     * TODO Move to another class
     * @param $params
     * @return string
     */
    public static function parseParams($params)
    {
        $output = [];
        if (!is_array($params)) {
            return htmlspecialchars(self::getVariableType($params));
        }
        foreach ($params as $param) {
            $output[] = htmlspecialchars(self::getVariableType($param));
        }
        return implode(',', $output);
    }
}