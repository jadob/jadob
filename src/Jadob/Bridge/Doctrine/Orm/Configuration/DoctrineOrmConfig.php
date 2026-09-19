<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Orm\Configuration;

use Jadob\Container\Config\ConfigNodeInterface;

final class DoctrineOrmConfig implements ConfigNodeInterface
{
    /**
     * @param array<string, ManagerConfiguration> $managers
     */
    public function __construct(
        private(set) array $managers = []
    ) {
    }

    public function configureManager(
        string $name
    ): ManagerConfiguration {
        $config = new ManagerConfiguration();
        $this->managers[$name] = $config;

        return $config;
    }
}