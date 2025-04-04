<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Contracts\EventDispatcher\EventDispatcherInterface;
use Jadob\EventDispatcher\EventDispatcher;
use Psr\Container\ContainerInterface;

class EventDispatcherProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            EventDispatcherInterface::class => [
                'class' => EventDispatcher::class,
            ]
        ];
    }
}