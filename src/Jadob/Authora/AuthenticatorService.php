<?php

namespace Jadob\Authora;

use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\IdentityProviderInterface;
use Jadob\Contracts\Auth\StatefulAuthenticatorInterface;
use Jadob\Contracts\Auth\StatelessAuthenticatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthenticatorService
{
    /**
     * @var array<string, AuthenticatorInterface>
     */
    private array $authenticators;
    /**
     * @var array<string, IdentityProviderInterface>
     */
    private array $identityProviders;

    public function registerNewAuthenticator(
        string                    $name,
        AuthenticatorInterface    $authenticator,
        IdentityProviderInterface $identityProvider,
    ): void
    {
        $this->authenticators[$name] = $authenticator;
        $this->identityProviders[$name] = $identityProvider;
    }

    /**
     * @return array<string, AuthenticatorInterface>
     */
    public function getAuthenticators(): array
    {
        return $this->authenticators;
    }

    public function getIdentityProvider(string $name): IdentityProviderInterface
    {
        return $this->identityProviders[$name];
    }

    public function getAuthenticator(string $name): AuthenticatorInterface
    {
        return $this->authenticators[$name];
    }

    public function determineEventListenerForRequest(
        Request $request
    ): ?string
    {
        foreach ($this->authenticators as $name => $authenticator) {
            if ($authenticator->supports($request)) {
                return $name;
            }
        }

        return null;
    }

}