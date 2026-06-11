<?php
declare(strict_types=1);

namespace Jadob\Auth\AccessToken;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

final readonly class AccessTokenStorage implements AccessTokenStorageInterface
{

    private const string TOKENS_KEY = 'auth.tokens';
    private const string TOKENS_ID_KEY = 'auth.tokens.id';

    public function storeAsCurrent(AccessToken $accessToken): int
    {
    }

    /**
     * @return array<AccessToken>
     */
    public function getAllTokens(SessionInterface $session): array
    {
        /** @var AccessToken[]|null $tokens */
        $tokens = $session->get(self::TOKENS_KEY);

        if ($tokens === null) {
            return [];
        }

        return $tokens;
    }

    public function fetchCurrentFromSession(SessionInterface $session): ?AccessToken
    {
    }

    public function saveToSession(SessionInterface $session, AccessToken $accessToken): int
    {
        $tokenIdFromSession = $session->get(self::TOKENS_ID_KEY);
        if ($tokenIdFromSession === null) {
            $tokenIdFromSession = 0;
        }

        $tokenIdFromSession++;

        $tokens = $session->get(self::TOKENS_KEY);
        if($tokens === null) {
            $tokens = [];
        }

        $tokens[$tokenIdFromSession] = $accessToken;

        $session->set(self::TOKENS_KEY, $tokens);

        return $tokenIdFromSession;
    }
}