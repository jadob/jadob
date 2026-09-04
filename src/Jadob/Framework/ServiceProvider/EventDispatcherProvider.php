<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\EventDispatcher\EventDispatcher;
use Psr\EventDispatcher\EventDispatcherInterface as PsrEventDispatcherInterface;

final readonly class EventDispatcherProvider implements ServiceProviderInterface
{
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface $config = null
    ): void {
        $builder
            ->set(EventDispatcher::class);


        $builder
            ->bind(PsrEventDispatcherInterface::class, EventDispatcher::class);
    }
}