<?php
declare(strict_types=1);

namespace Jadob\Auth\AccessToken;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Non-persistent across requests.
 */
class AccessTokenStorage
{
    public function storeAsCurrent(AccessToken $accessToken): int
    {
    }

    /**
     * @return array<AccessToken>
     */
    public function getAllTokens(): array
    {
    }

    public function fetchFromSession(SessionInterface $session): void
    {
    }
    public function saveToSession(SessionInterface $session)
    {
    }
}