<?php

namespace Jadob\Debug\ErrorHandler;

/**
 * Class DevelopmentErrorHandler
 * @package Jadob\Debug\ErrorHandler
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DevelopmentErrorHandler implements ErrorHandlerInterface
{

    public function registerErrorHandler()
    {
        if (PHP_SAPI !== 'cli') {
            set_error_handler(function ($errno, $errstr, $errfile, $errline) {
                throw new \ErrorException($errstr, $errno, 1, $errfile, $errline);
            });
        }
    }

    public function registerExceptionHandler()
    {
        if (PHP_SAPI !== 'cli') {
            set_exception_handler(function ($exception) {
                include __DIR__ . '/../templates/error_view.php';
            });
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
            return htmlspecialchars(self::getVariableType($params));
        }
        foreach ($params as $param) {
            $output[] = htmlspecialchars(self::getVariableType($param));
        }
        return implode(',', $output);
    }
}