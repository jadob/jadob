<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\CircularServiceProviders;

use Jadob\Contracts\DependencyInjection\ConfigNode;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

final readonly class BarServiceProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function getParentServiceProviders(): array
    {
        return [
            FooServiceProvider::class,
        ];
    }

    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNode $config = null
    ): void
    {

    }
}