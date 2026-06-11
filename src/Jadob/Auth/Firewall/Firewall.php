<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Jadob\Auth\AuthenticatorInterface;
use Jadob\Auth\EntryPointInterface;
use Jadob\Auth\Identity\IdentityPickerInterface;
use Jadob\Auth\Identity\IdentityProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

class Firewall implements FirewallInterface
{
    /**
     * @param string $name
     * @param RequestMatcherInterface $requestMatcher
     * @param array<AuthenticatorInterface> $authenticators
     * @param IdentityProviderInterface $identityProvider
     * @param EntryPointInterface|null $entryPoint
     * @param bool $stateless
     * @throws FirewallLogicException
     */
    public function __construct(
        private string                    $name,
        private RequestMatcherInterface   $requestMatcher,
        private array                     $authenticators,
        private IdentityProviderInterface $identityProvider,
        private ?EntryPointInterface      $entryPoint = null,
        private bool                      $stateless = false,
        private bool                      $identityStackingEnabled = false,
        private ?IdentityPickerInterface  $identityPicker = null
    )
    {
        if ($this->stateless && $this->identityStackingEnabled) {
            throw new FirewallLogicException(
                sprintf(
                    'Identity stacking is not available for stateless firewalls. Set identityStackingEnabled to false for firewall %s or make it stateful.',
                    $this->name,
                )
            );
        }
    }

    /**
     * Checks if given request should be handled by this firewall.
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return $this
            ->requestMatcher
            ->matches($request);
    }

    public function isStateless(): bool
    {
        return $this->stateless;
    }

    public function isIdentityStackingEnabled(): bool
    {
        return $this->identityStackingEnabled;
    }

    public function getIdentityProvider(): IdentityProviderInterface
    {
        return $this->identityProvider;
    }

    public function getIdentityPicker(): IdentityPickerInterface
    {
        return $this->identityPicker;
    }

    public function getAuthenticators(): array
    {
        return $this->authenticators;
    }

    public function getEntryPoint(): EntryPointInterface
    {
        return $this->entryPoint;
    }
}