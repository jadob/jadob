<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Exception;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class UserNotFoundException extends AuthenticationException
{

    /**
     * @return static
     */
    public static function userNotFound(): self
    {
        return new self('security.user_not_found');
    }

    public static function emptyCredentials(): self
    {
        return new self('security.empty_credentials');
    }

}