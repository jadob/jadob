<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

class NonExistingConfigNodeServiceProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return 'yeti';
    }

    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {

    }
}