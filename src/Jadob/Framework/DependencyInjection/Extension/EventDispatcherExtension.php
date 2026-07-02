<?php
declare(strict_types=1);

namespace Jadob\Framework\DependencyInjection\Extension;

use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ExtendedContainerInterface;
use Jadob\Contracts\EventDispatcher\EventDispatcherInterface;
use Jadob\EventDispatcher\EventDispatcher;

class EventDispatcherExtension implements ContainerExtensionInterface
{
    public function onContainerBuild(ExtendedContainerInterface $container): void
    {
        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $container->get(EventDispatcherInterface::class);
        foreach ($container->getTaggedServices('event_listener') as $listener) {
            $eventDispatcher->addListener($listener);
        }
    }
}