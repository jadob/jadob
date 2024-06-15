<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

class AuthenticatorService
{
    public function __construct(
        /**
         * @var array<string, AuthenticatorInterface>
         */
        protected array $authenticators = []
    )
    {
    }

    public function getAuthenticators(): array
    {
        return $this->authenticators;
    }

}