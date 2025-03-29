<?php
declare(strict_types=1);

namespace Jadob\Core\Session;

use SessionHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SessionHandlerFactory
{
    public function create(): SessionHandlerInterface
    {
        return new NativeFileSessionHandler();
    }
}