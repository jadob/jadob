<?php

namespace Jadob\Framework\DependencyInjection\Extension;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Jadob\Contracts\EventDispatcher\EventDispatcherInterface;
use Jadob\EventDispatcher\EventDispatcher;

class EventDispatcherExtension implements ContainerExtensionInterface
{

    public function onContainerBuild(Container $container): void
    {
        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $container->get(EventDispatcherInterface::class);
        foreach ($container->getTaggedServices('event_listener') as $listener) {
            $eventDispatcher->addListener($listener);
        }
    }

}