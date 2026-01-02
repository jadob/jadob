<?php

declare(strict_types=1);

namespace Jadob\MessageBus\ServiceProvider;

use Closure;
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

    /**
     * @return array|array[]|Closure[]|object[]
     */
    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            CommandBus::class => function (Container $container) {
                return new CommandBus(
                    $container->getTaggedServices('message_bus.command_handler')
                );
            },
            QueryBus::class => function (Container $container) {
                return new QueryBus(
                    $container->getTaggedServices('message_bus.query_handler')
                );
            },
        ];
    }
}
