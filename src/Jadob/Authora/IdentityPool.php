<?php

declare(strict_types=1);

namespace Jadob\Authora;

use Jadob\Authora\Exception\IdentityPoolException;
use Jadob\Contracts\Auth\Identity;
use Jadob\Contracts\Auth\IdentityPoolInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IdentityPool implements IdentityPoolInterface
{
    public function getCurrentIdentityFromSession(
        SessionInterface $session,
        string           $authenticatorName
    ): ?Identity
    {
        $authenticatorKey = $this->createAuthenticatorStackSessionKey($authenticatorName);
        $currentKey = $this->createAuthenticatorStackCurrentIdentitySessionKey($authenticatorName);

        $identities = $session->get($authenticatorKey);
        $current = $session->get($currentKey);

        if ($identities === null || $current === null) {
            return null;
        }


        return $identities[$current];
    }

    public function removeIdentityByIndex(
        SessionInterface $session,
        string           $authenticatorName,
        int              $index
    ): void
    {
        $authenticatorKey = $this->createAuthenticatorStackSessionKey($authenticatorName);
        $identities = $session->get($authenticatorKey);

        unset($identities[$index]);
        $session->set($authenticatorKey, $identities);
    }

    public function findIdentityByIndex(
        SessionInterface $session,
        string           $authenticatorName,
        int              $index
    ): ?Identity
    {
        $authenticatorKey = $this->createAuthenticatorStackSessionKey($authenticatorName);
        $identities = $session->get($authenticatorKey);

        if ($identities === null || count($identities) === 0) {
            return null;
        }

        if(!array_key_exists($index, $identities)) {
            throw new IdentityPoolException(
                sprintf(
                    'Identity index "%s" not found in authenticator "%s"',
                    $index,
                    $authenticatorName
                )
            );
        }

        return $identities[$index];
    }

    public function pushIdentity(Identity $identity, string $authenticatorName, SessionInterface $session): int
    {
        $authenticatorSessionKey = $this->createAuthenticatorStackSessionKey($authenticatorName);
        $identities = $session->get($authenticatorSessionKey);

        $identitiesCountKey = $this->createAuthenticatorStackTotalIdentitiesCountKey($authenticatorName);
        $identitiesCount = $session->get($identitiesCountKey);

        if ($identitiesCount === null) {
            $identitiesCount = 0;
        } else {
            $identitiesCount++;
        }

        if ($identities === null) {
            $identities = [];
        }


        $identities[$identitiesCount] = $identity;


        $session->set($identitiesCountKey, $identitiesCount);
        $session->set($authenticatorSessionKey, $identities);
        return $identitiesCount;

    }

    public function listIdentities(SessionInterface $session, string $authenticatorName): array
    {
        $authenticatorKey = $this->createAuthenticatorStackSessionKey($authenticatorName);

        return $session->get($authenticatorKey) ?? [];
    }

    /**
     * @throws IdentityPoolException
     */
    public function setCurrent(int $identityIndex, string $authenticatorName, SessionInterface $session): void
    {
        $authenticatorSessionKey = $this->createAuthenticatorStackSessionKey($authenticatorName);
        $identities = $session->get($authenticatorSessionKey);

        if($identities === null || count($identities) === 0) {
            throw new IdentityPoolException(
                sprintf(
                    'Authenticator "%s" has no identities stored.',
                    $identityIndex,
                )
            );
        }

        if (!array_key_exists($identityIndex, $identities)) {
            throw new IdentityPoolException(
                sprintf(
                    'Attempted to set non-existing identity index "%s" as default for authenticator "%s" ',
                    $identityIndex,
                    $authenticatorName,
                )
            );
        }

        $currentKey = $this->createAuthenticatorStackCurrentIdentitySessionKey($authenticatorName);
        $session->set($currentKey, $identityIndex);
    }

    private function createAuthenticatorStackTotalIdentitiesCountKey(string $authenticatorName): string
    {
        return sprintf('authenticator.%s.total', $authenticatorName);
    }

    private function createAuthenticatorStackCurrentIdentitySessionKey(string $authenticatorName): string
    {
        return sprintf('authenticator.%s.current', $authenticatorName);
    }

    private function createAuthenticatorStackSessionKey(string $authenticatorName): string
    {
        return sprintf('authenticator.%s', $authenticatorName);
    }
}