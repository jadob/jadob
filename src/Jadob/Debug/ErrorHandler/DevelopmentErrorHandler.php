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
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            throw new \Error($errstr, $errno);
        });
    }

    public function registerExceptionHandler()
    {
        set_exception_handler(function ($exception) {
            include __DIR__.'/../templates/error_view.php';
        });
    }
}