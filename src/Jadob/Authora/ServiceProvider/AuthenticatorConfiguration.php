<?php

namespace Jadob\Authora\ServiceProvider;

class AuthenticatorConfiguration
{

    private(set) string $userProviderServiceId;
    private(set) string $authenticatorServiceId;
    private(set) bool $identityStackingEnabled = false;

    public function __construct(
        private(set) readonly string $name
    )
    {

    }

    public function withUserProvider(string $userProviderServiceId): self
    {
        $this->userProviderServiceId = $userProviderServiceId;

        return $this;
    }

    public function withAuthenticator(string $serviceId): self
    {
        $this->authenticatorServiceId = $serviceId;

        return $this;
    }

    public function withIdentityStacking(): self
    {
        $this->identityStackingEnabled = true;

        return $this;
    }
}