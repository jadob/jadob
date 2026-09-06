<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class ApiServiceProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function getParentServiceProviders(): array
    {
        return [
            AuthServiceProvider::class
        ];
    }

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {

    }
}