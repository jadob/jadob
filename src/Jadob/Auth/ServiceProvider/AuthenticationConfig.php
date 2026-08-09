<?php

declare(strict_types=1);

namespace Jadob\Auth\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;

class AuthenticationConfig implements ConfigNodeInterface
{
    /**
     * @var array<non-empty-string,FirewallConfig>
     */
    private(set) array $firewalls = [];

    /**
     * @param non-empty-string $name
     * @return FirewallConfig
     */
    public function createFirewall(string $name): FirewallConfig
    {
        $this->firewalls[$name] = new FirewallConfig($name);

        return $this->firewalls[$name];
    }
}