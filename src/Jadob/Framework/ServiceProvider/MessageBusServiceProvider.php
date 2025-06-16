<?php

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\MessageBus\CommandBus;
use Jadob\MessageBus\QueryBus;
use Psr\Container\ContainerInterface;

class MessageBusServiceProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            CommandBus::class => function (Container $container) {
                return new CommandBus(
                    $container->getTaggedServices('command_bus_handler')
                );
            },
            QueryBus::class => function (Container $container) {
                return new QueryBus(
                    $container->getTaggedServices('query_bus_handler')
                );
            },

        ];
    }
}