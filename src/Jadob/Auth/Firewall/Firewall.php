<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Jadob\Auth\AuthenticatorInterface;
use Jadob\Auth\EntryPointInterface;
use Jadob\Auth\Identity\IdentityProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

class Firewall
{
    /**
     * @param string $name
     * @param RequestMatcherInterface $requestMatcher
     * @param array<AuthenticatorInterface> $authenticators
     * @param IdentityProviderInterface $identityProvider
     * @param EntryPointInterface|null $entryPoint
     * @param bool $stateless
     * @throws FirewallConfigurationException
     */
    public function __construct(
        private(set) string                    $name,
        private(set) RequestMatcherInterface   $requestMatcher,
        private(set) array                     $authenticators,
        private(set) IdentityProviderInterface $identityProvider,
        private(set) ?EntryPointInterface      $entryPoint = null,
        private(set) bool                      $stateless = false,
        private(set) bool                      $identityStackingEnabled = false
    )
    {
        if ($this->stateless && $this->identityStackingEnabled) {
            throw new FirewallConfigurationException(
                sprintf(
                    'Identity stacking is not available for stateless firewalls. Set identityStackingEnabled to false for
                    firewall %s or make it stateful.', $this->name,
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
}