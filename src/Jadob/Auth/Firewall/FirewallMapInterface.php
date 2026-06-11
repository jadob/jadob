<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Symfony\Component\HttpFoundation\Request;

interface FirewallMapInterface
{
    public function match(Request $request): ?FirewallInterface;
}