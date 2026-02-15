<?php
declare(strict_types=1);

namespace Jadob\Authora\ServiceProvider;

class AuthoraConfiguration
{
    /**
     * @var array<AuthenticatorConfiguration>
     */
    private(set) array $authenticators = [];

    public function createAuthenticator(
        string $name
    ): AuthenticatorConfiguration
    {
        $authenticator = new AuthenticatorConfiguration($name);
        $this->authenticators[$name] = $authenticator;
        return $authenticator;
    }
}