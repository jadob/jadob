<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Exception;

/**
 * @deprecated
 * @TODO should be moved to security-contracts
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class InvalidCredentialsException extends AuthenticationException
{
    public static function invalidCredentials(): self
    {
        return new self('security.invalid_credentials');
    }
}