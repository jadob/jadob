<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\CircularServiceProviders;

use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class FooServiceProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function getParentServiceProviders(): array
    {
        return [BarServiceProvider::class];
    }

    public function getConfigNode(): ?string
    {
        return 'foo';
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