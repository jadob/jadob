<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class DatabaseServiceProvider implements ServiceProviderInterface
{

    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface $config = null
    ): void
    {
    }
}