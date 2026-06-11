<?php
declare(strict_types=1);

namespace Jadob\Auth\AccessToken;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface AccessTokenStorageInterface
{

    /**
     * @return array<AccessToken>
     */
    public function getAllTokens(SessionInterface $session): array;

    public function fetchCurrentFromSession(SessionInterface $session): ?AccessToken;

    public function saveToSession(SessionInterface $session, AccessToken $accessToken): int;
}