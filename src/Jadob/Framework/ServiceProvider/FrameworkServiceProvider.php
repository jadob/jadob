<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

class FrameworkServiceProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'framework';
    }

    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
    }
}