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
        $sessionKey = sprintf('authenticator.%s', $authenticatorName);
        $session->set($sessionKey, $accessToken);
    }

    public function getCurrentAccessTokenFromSession(
        SessionInterface $session,
        string           $authenticatorName
    ): ?AccessToken
    {
        $sessionKey = sprintf('authenticator.%s', $authenticatorName);
        return $session->get($sessionKey);
    }
}