<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Exception;

/**
 * @TODO should be moved to security-contracts
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class UserNotFoundException extends AuthenticationException
{

    public static function userNotFound(): self
    {
        return new self('security.user_not_found');
    }

    public static function emptyCredentials(): self
    {
        return new self('security.empty_credentials');
    }

}