<?php
declare(strict_types=1);

namespace Jadob\Auth\AccessToken;

use RuntimeException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use function array_key_exists;
use function sprintf;

final readonly class AccessTokenStorage implements AccessTokenStorageInterface
{
    private const string CURRENT_TOKEN_KEY = 'auth.current_token';
    private const string TOKENS_KEY = 'auth.tokens';
    private const string TOKENS_ID_KEY = 'auth.tokens_seq';

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

    public function removeTokenFromSession(
        SessionInterface $session,
        int $tokenId
    ): void {
        /** @var array<array-key, AccessToken> $tokens */
        $tokens = $session->get(self::TOKENS_KEY);

        if (
            $tokens === null
            || (is_array($tokens) && array_key_exists($tokenId, $tokens) === false)
        ) {
            throw new RuntimeException(
                sprintf('Access token with id "%s" does not exist in session.', $tokenId)
            );
        }

        unset($tokens[$tokenId]);
        $session->set(self::TOKENS_KEY, $tokens);
    }

    public function saveToSession(SessionInterface $session, AccessToken $accessToken): int
    {
        $tokenIdFromSession = $session->get(self::TOKENS_ID_KEY);

        if ($tokenIdFromSession === null) {
            $tokenIdFromSession = 0;
        }

        $tokenIdFromSession++;

        $tokens = $session->get(self::TOKENS_KEY);

        if ($tokens === null) {
            $tokens = [];
        }

        $tokens[$tokenIdFromSession] = $accessToken;

        $session->set(self::TOKENS_KEY, $tokens);
        $session->set(self::TOKENS_ID_KEY, $tokenIdFromSession);

        return $tokenIdFromSession;
    }

    public function storeCurrent(SessionInterface $session, int $tokenId): void
    {
        $session->set(self::CURRENT_TOKEN_KEY, $tokenId);
    }
}