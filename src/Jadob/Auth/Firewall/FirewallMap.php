<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Symfony\Component\HttpFoundation\Request;
use function array_find;

final readonly class FirewallMap
{
    /**
     * @param array<Firewall> $firewalls
     */
    public function __construct(
        private array $firewalls = [],
    ) {
    }


    public function match(Request $request): ?Firewall
    {
        return array_find(
            $this->firewalls,
            fn(Firewall $firewall) => $firewall->supports($request)
        );
    }
}