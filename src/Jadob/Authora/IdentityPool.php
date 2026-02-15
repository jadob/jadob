<?php

declare(strict_types=1);

namespace Jadob\Authora;

use Jadob\Contracts\Auth\Identity;
use Jadob\Contracts\Auth\IdentityPoolInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IdentityPool implements IdentityPoolInterface
{
    public function storeAsCurrent(Identity $accessToken, string $authenticatorName, SessionInterface $session): void
    {
        $sessionKey = sprintf('authenticator.%s', $authenticatorName);
        $session->set($sessionKey, $accessToken);
    }

    public function getCurrentIdentityFromSession(
        SessionInterface $session,
        string           $authenticatorName
    ): ?Identity {
        $sessionKey = sprintf('authenticator.%s', $authenticatorName);
        return $session->get($sessionKey);
    }
}