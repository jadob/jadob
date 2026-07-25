<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ConfigNode;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class AuthServiceProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function getParentServiceProviders(): array
    {
        return [
            DatabaseServiceProvider::class
        ];
    }

    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNode $config = null
    ): void
    {
    }
}