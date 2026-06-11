<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Symfony\Component\HttpFoundation\Request;
use function array_find;

final readonly class FirewallMap implements FirewallMapInterface
{
    /**
     * @param array<Firewall> $firewalls
     */
    public function __construct(
        private array $firewalls = [],
    ) {
    }


    public function match(Request $request): ?FirewallInterface
    {
        return array_find(
            $this->firewalls,
            fn(FirewallInterface $firewall) => $firewall->supports($request)
        );
    }
}