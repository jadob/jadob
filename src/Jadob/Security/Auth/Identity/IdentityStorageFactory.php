<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\AuthenticatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @deprecated
 * @internal
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
readonly class IdentityStorageFactory
{
    public function createFor(
        AuthenticatorInterface $authenticator,
        SessionInterface $session
    ): IdentityStorageInterface {
        if ($authenticator->isStateless()) {
            return new StatelessIdentityStorage();
        }

        return new SessionAwareIdentityStorage(
            $session
        );
    }
}