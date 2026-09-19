<?php declare(strict_types=1);

namespace Jadob\Contracts\Auth;

use Exception;

/**
 * Base class for anything bad that happens during the authentication.
 * @license MIT
 */
class AuthenticationException extends Exception
{
}