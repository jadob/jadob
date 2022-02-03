<?php
declare(strict_types=1);

namespace Jadob\Debug\ErrorHandler;

use Psr\Log\LoggerInterface;

/**
 * Class HandlerFactory
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class HandlerFactory
{
    /**
     * @param $env
     * @param LoggerInterface $logger
     *
     * @return ErrorHandlerInterface
     */
    public static function factory(string $env, LoggerInterface $logger)
    {
        if ($env === 'dev') {
            return new DevelopmentErrorHandler($logger);
        }

        return new ProductionErrorHandler($logger);
    }
}