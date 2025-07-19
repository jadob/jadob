<?php

declare(strict_types=1);

namespace Jadob\Authora;

use Jadob\Contracts\Auth\AccessToken;
use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AccessTokenStorageService implements AccessTokenStorageInterface
{
    public function storeAsCurrent(AccessToken $accessToken, string $authenticatorName, SessionInterface $session): void
    {
        // TODO: Implement storeCurrentInSession() method.
    }

    public function getCurrentAccessTokenFromSession(SessionInterface $session,): ?AccessToken
    {
        // TODO: Implement getCurrentAccessTokenFromSession() method.
    }
}