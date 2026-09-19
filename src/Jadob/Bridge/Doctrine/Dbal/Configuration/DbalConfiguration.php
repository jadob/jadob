<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Dbal\Configuration;

use Jadob\Container\Config\ConfigNodeInterface;

final class DbalConfiguration implements ConfigNodeInterface
{
    /**
     * @var array<string, class-string>
     */
    private(set) array $types = [];

    /**
     * @var array<string, DbalConnectionConfig>
     */
    private(set) array $connections = [];

    public function addType(string $name, string $type): self
    {
        $this->types[$name] = $type;
        return $this;
    }

    public function configureConnection(
        string $name,
    ): DbalConnectionConfig
    {
        $config = new DbalConnectionConfig();
        $this->connections[$name] = $config;
        return $config;
    }
}