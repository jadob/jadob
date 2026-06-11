<?php
declare(strict_types=1);

namespace Jadob\Auth\ServiceProvider;

class FirewallConfig
{
    private array $authenticators = [];
    private bool $stateless = false;
    private bool $identityStackingEnabled = false;
    private(set) ?string $entryPointServiceId = null;
    private(set) ?string $requestMatcherServiceId = null;
    private(set) ?string $identityProviderServiceId = null;
    private(set) ?string $identityPickerServiceId = null;

    public function __construct(
        private string $name,
    )
    {
    }

    public function withEntryPointServiceId(string $entryPointServiceId): self
    {
        $this->entryPointServiceId = $entryPointServiceId;
        return $this;
    }

    public function withRequestMatcherServiceId(string $requestMatcherServiceId): self
    {
        $this->requestMatcherServiceId = $requestMatcherServiceId;
        return $this;
    }

    public function withAuthenticator(string $authenticatorServiceId): self
    {
        $this->authenticators[] = $authenticatorServiceId;
        return $this;
    }

    public function enableStateless(): self
    {
        $this->stateless = true;
        return $this;
    }

    public function enableIdentityStacking(): self
    {
        $this->identityStackingEnabled = true;
        return $this;
    }

    /**
     * @return array<string|class-string>
     */
    public function getAuthenticators(): array
    {
        return $this->authenticators;
    }

    public function isStateless(): bool
    {
        return $this->stateless;
    }

    public function isIdentityStackingEnabled(): bool
    {
        return $this->identityStackingEnabled;
    }

    public function withIdentityProviderServiceId(string $identityProviderServiceId): self
    {
        $this->identityProviderServiceId = $identityProviderServiceId;
        return $this;
    }

    public function withIdentityPickerServiceId(string $identityPickerServiceId): self
    {
        $this->identityPickerServiceId = $identityPickerServiceId;
        return $this;
    }
}