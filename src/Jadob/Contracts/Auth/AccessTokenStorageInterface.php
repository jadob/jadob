<?php

namespace Jadob\Contracts\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface AccessTokenStorageInterface
{
    public function storeAsCurrent(
        AccessToken $accessToken,
        string $authenticatorName,
        SessionInterface $session
    ): void;

    public function getCurrentAccessTokenFromSession(
        SessionInterface $session,
        string $authenticatorName
    ): ?AccessToken;
}