<?php
declare(strict_types=1);

namespace Jadob\Runtime;

use Jadob\Runtime\Type\GenericRuntime;
use Jadob\Runtime\Type\OsxRuntime;

/**
 * Tries to get some information about the environment that our app is running.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RuntimeFactory
{

    public static function fromGlobals(): RuntimeInterface
    {
        $systemName = php_uname('s');

        if($systemName === 'Darwin') {
            return new OsxRuntime();
        }

        return new GenericRuntime();
    }
}