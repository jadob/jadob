<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ConfigNode;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class DatabaseServiceProvider implements ServiceProviderInterface
{

    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNode $config = null
    ): void
    {
    }
}