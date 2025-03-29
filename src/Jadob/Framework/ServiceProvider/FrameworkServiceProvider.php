<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ContainerExtensionProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\DependencyInjection\Extension\InjectLoggerAutowireExtension;
use Jadob\Framework\ServiceTag;
use Psr\Container\ContainerInterface;

class FrameworkServiceProvider implements ServiceProviderInterface, ContainerExtensionProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'framework';
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        $services = [];

        $services['jadob.container.logger_extension'] = static function (ContainerInterface $container) {
            return new InjectLoggerAutowireExtension();
        };

        return $services;
    }

    public function getAutowiringExtensions(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            $container->get('jadob.container.logger_extension')
        ];
    }
}