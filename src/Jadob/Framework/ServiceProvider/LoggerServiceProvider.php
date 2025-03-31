<?php

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\DependencyInjection\Extension\InjectLoggerAutowireExtension;
use Psr\Container\ContainerInterface;

class LoggerServiceProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return 'logger';
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {

        $services = [];

        $services['jadob.container.logger_extension'] = static function (ContainerInterface $container) {
            return new InjectLoggerAutowireExtension();
        };

        return $services;
    }
}