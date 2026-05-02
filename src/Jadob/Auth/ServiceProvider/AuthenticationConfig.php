<?php
declare(strict_types=1);

namespace Jadob\Auth\ServiceProvider;

class AuthenticationConfig
{
    private(set) array $firewalls = [];

    public function createFirewall(string $name): FirewallConfig
    {
        $this->firewalls[$name] = new FirewallConfig($name);

        return $this->firewalls[$name];
    }
}