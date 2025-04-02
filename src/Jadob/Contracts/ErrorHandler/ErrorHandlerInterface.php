<?php
declare(strict_types=1);

namespace Jadob\Contracts\ErrorHandler;

/**
 * Interface ErrorHandlerInterface
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ErrorHandlerInterface
{
    public function registerErrorHandler();

    public function registerExceptionHandler();
}