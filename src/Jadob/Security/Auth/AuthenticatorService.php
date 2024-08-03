<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\Identity\IdentityStorageFactory;
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
         * @var array<non-empty-string, UserProviderInterface>
         */
        protected array                  $userProviders = [],
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
        return $this->identityStorageFactory
            ->createFor(
                $this->authenticators[$authenticatorName],
                $session
            )
            ->getUser($authenticatorName);

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


}