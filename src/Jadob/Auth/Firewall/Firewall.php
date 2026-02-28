<?php

namespace Jadob\Auth\Firewall;

use Jadob\Auth\EntryPointInterface;
use Jadob\Auth\Identity\IdentityProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

class Firewall
{
    public function __construct(
        private(set) string                    $name,
        private(set) RequestMatcherInterface   $requestMatcher,
        private(set) array                     $authenticators,
        private(set) IdentityProviderInterface $identityProvider,
        private(set) ?EntryPointInterface      $entryPoint = null,
        private(set) bool                      $stateless = false
    )
    {
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