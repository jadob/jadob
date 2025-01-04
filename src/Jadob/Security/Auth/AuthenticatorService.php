<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\Identity\IdentityProviderInterface;
use Jadob\Security\Auth\Identity\IdentityStorageFactory;
use Jadob\Security\Auth\Identity\RefreshableIdentityProviderInterface;
use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AuthenticatorService
{
    public function __construct(
        protected IdentityStorageFactory $identityStorageFactory,
        /**
         * @var array<non-empty-string, AuthenticatorInterface>
         */
        protected array                  $authenticators = [],

        /**
         * @var array<non-empty-string, IdentityProviderInterface>
         */
        protected array                  $identityProviders = [],
        
        /**
         * @var array<non-empty-string, RefreshableIdentityProviderInterface>
         */
        protected array                  $refreshableIdentityProviders = [],
        
        
    )
    {
    }

    /**
     * @return array<string, AuthenticatorInterface>
     */
    public function getAuthenticators(): array
    {
        return $this->authenticators;
    }

    public function getUserProviderFor(string $authenticatorName): UserProviderInterface
    {
        return $this->userProviders[$authenticatorName];
    }


    public function getStoredIdentity(
        SessionInterface $session,
        string           $authenticatorName
    ): ?UserInterface
    {

        $user = $this->identityStorageFactory
            ->createFor(
                $this->authenticators[$authenticatorName],
                $session
            )
            ->getUser($authenticatorName);
        
        return $user;
    }

    public function storeIdentity(
        UserInterface    $user,
        SessionInterface $session,
        string           $authenticatorName,
    ): void
    {
        $this
            ->identityStorageFactory
            ->createFor(
                $this->authenticators[$authenticatorName],
                $session
            )
            ->setUser(
                $user,
                $authenticatorName
            );
    }

    public function refreshIdentity(
        UserInterface $identity,
        string $authenticatorName
    ): UserInterface
    {
        if(!array_key_exists($authenticatorName, $this->refreshableIdentityProviders)) {
            return $identity;
        }

        return $this
            ->refreshableIdentityProviders[$authenticatorName]
            ->refreshIdentity($identity);
    }
}