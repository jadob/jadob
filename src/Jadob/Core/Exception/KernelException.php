<?php
declare(strict_types=1);

namespace Jadob\Core\Exception;

use Exception;

/**
 * Class KernelException
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class KernelException extends Exception
{
    /**
     * @param string $routeName
     * @return KernelException
     */
    public static function invalidControllerPassed(string $routeName)
    {
        return new self('Route "' . $routeName . '" should provide a valid FQCN or Closure, null given');
    }
}