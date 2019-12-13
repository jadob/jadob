<?php

namespace Jadob\Debug\ErrorHandler;

use Psr\Log\LoggerInterface;

/**
 * Class HandlerFactory
 *
 * @package Jadob\Debug\ErrorHandler
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class HandlerFactory
{
    /**
     * @param  $env
     * @param  LoggerInterface $logger
     * @return ErrorHandlerInterface
     */
    public static function factory($env, LoggerInterface $logger)
    {
        if ($env === 'dev') {
            return new DevelopmentErrorHandler($logger);
        }

        return new ProductionErrorHandler();
    }
}