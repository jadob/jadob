<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\CircularServiceProviders;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

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
        ?ConfigNodeInterface $config = null
    ): void
    {

    }
}