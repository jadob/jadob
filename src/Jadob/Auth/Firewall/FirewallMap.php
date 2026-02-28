<?php

namespace Jadob\Auth\Firewall;

use Symfony\Component\HttpFoundation\Request;

final readonly class FirewallMap
{
    /**
     * @param array<Firewall> $firewalls
     */
    public function __construct(
        private array $firewalls = [],
    )
    {

    }


    public function match(Request $request): ?Firewall
    {
        return \array_find(
            $this->firewalls,
            fn(Firewall $firewall) => $firewall->supports($request)
        );
    }

}