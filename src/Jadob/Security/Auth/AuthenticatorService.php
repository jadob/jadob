<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

class AuthenticatorService
{
    public function __construct(
        /**
         * @var array<string, AuthenticatorInterface>
         */
        protected array $authenticators = [],

        /**
         * @var array<string, UserProviderInterface>
         */
        protected array $userProviders = []
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


}