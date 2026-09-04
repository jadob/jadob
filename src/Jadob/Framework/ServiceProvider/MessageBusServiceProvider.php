<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\MessageBus\CommandBus;
use Jadob\MessageBus\QueryBus;

final readonly class MessageBusServiceProvider implements ServiceProviderInterface
{
    public function register(
        ContainerBuilderInterface $builder,
        ConfigNodeInterface|null $config = null,
    ): void
    {
        $builder
            ->set(CommandBus::class)
            ->withArgument(
                'handlers', Reference::taggedServices('command_bus_handler')
            );

        $builder
            ->set(QueryBus::class)
            ->withArgument(
                'handlers', Reference::taggedServices('query_bus_handler')
            );
    }
}