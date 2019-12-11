<?php

namespace Jadob\Debug\ErrorHandler;

/**
 * Interface ErrorHandlerInterface
 *
 * @package Jadob\Debug\ErrorHandler
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ErrorHandlerInterface
{

    public function registerErrorHandler();

    public function registerExceptionHandler();
    
}