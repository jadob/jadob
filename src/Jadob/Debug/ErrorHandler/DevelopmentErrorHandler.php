<?php

namespace Jadob\Debug\ErrorHandler;

use Psr\Log\LoggerInterface;

/**
 * Class DevelopmentErrorHandler
 *
 * @package Jadob\Debug\ErrorHandler
 * @author  pizzaminded <miki@appvende.net>
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

    public function registerErrorHandler()
    {

        $logger = $this->logger;
        if (PHP_SAPI !== 'cli') {
            \set_error_handler(
                function ($errno, $errstr, $errfile, $errline) use ($logger) {

                    if ($errno === \E_USER_DEPRECATED) {
                        $context['file'] = $errfile;
                        $context['line'] = $errline;
                        $context['stacktrace'] = \debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS);
                        $logger->warning($errstr, $context);
                        return;
                    }

                    throw new \ErrorException($errstr, $errno, 1, $errfile, $errline);
                }
            );
        }
    }

    public function registerExceptionHandler()
    {
        $logger = $this->logger;


        if (PHP_SAPI !== 'cli') {
            \set_exception_handler(
                function (\Throwable $exception) use ($logger) {
                    http_response_code(500);
                    error_log(\get_class($exception) . ': ' . $exception->getMessage());
                    error_log('Stack Trace: ');
                    error_log($exception->getTraceAsString());

                    $logger->critical(
                        $exception->getMessage(), [
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace' => $exception->getTrace(),
                        'type' => \get_class($exception)
                        ]
                    );
                    include __DIR__ . '/../templates/error_view.php';
                }
            );
        }
    }


    public static function getVariableType($variable)
    {
        if ($variable === null) {
            return 'null';
        }
        if (\is_scalar($variable)) {
            return $variable;
        }
        if (\is_object($variable)) {
            return \get_class($variable);
        }
        if (\is_array($variable)) {
            return 'array';
        }
        if (\is_resource($variable)) {
            return 'resource';
        }
        return 'unknown';
    }

    public static function parseParams($params)
    {
        $output = [];
        if (!\is_array($params)) {
            return \htmlspecialchars(self::getVariableType($params));
        }
        foreach ($params as $param) {
            $output[] = \htmlspecialchars(self::getVariableType($param));
        }
        return \implode(',', $output);
    }
}