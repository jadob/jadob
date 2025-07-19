<?php

namespace Jadob\Authora\ServiceProvider;

class AuthoraConfiguration
{
    /**
     * @var array<string, string|class-string>
     */
    private(set) array $authenticators = [];

    /**
     * @var array<string, string|class-string>
     */
    private(set) array $userProviders = [];

    public function withAuthenticator(
        string $name,
        string $authenticatorServiceId,
        string $userProviderServiceId
    ): self
    {
        $this->authenticators[$name] = $authenticatorServiceId;
        $this->userProviders[$name] = $userProviderServiceId;

        return $this;
    }
}