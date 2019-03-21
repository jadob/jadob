<?php

namespace Jadob\Debug\ErrorHandler;

use Psr\Log\LoggerInterface;

/**
 * Class HandlerFactory
 * @package Jadob\Debug\ErrorHandler
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class HandlerFactory
{
    /**
     * @param $env
     * @return ErrorHandlerInterface
     */
    public static function factory($env)
    {
        if ($env === 'dev') {
            return new DevelopmentErrorHandler();
        }

        return new ProductionErrorHandler();
    }
}