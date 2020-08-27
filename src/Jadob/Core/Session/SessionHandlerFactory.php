<?php
declare(strict_types=1);

namespace Jadob\Core\Session;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SessionHandlerFactory
{

    public function create(Request $request)
    {
        return new NativeFileSessionHandler();
    }
}