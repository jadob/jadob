<?php
declare(strict_types=1);

namespace Jadob\Core\Session;

use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SessionHandlerFactory
{

    public function create()
    {
        return new NativeFileSessionHandler();
    }
}