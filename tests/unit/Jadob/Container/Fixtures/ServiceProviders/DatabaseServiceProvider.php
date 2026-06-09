<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'database';
    }

    /**
     * @param array<mixed> $config
     * @return array<string, \Closure>
     */
    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [];
    }
}