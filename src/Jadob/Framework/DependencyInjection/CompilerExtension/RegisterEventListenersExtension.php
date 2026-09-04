<?php
declare(strict_types=1);

namespace Jadob\Framework\DependencyInjection\CompilerExtension;

use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use function class_implements;
use function in_array;

final readonly class RegisterEventListenersExtension implements CompilerExtensionInterface
{
    public function onContainerBuild(ServiceGraph $serviceGraph): void
    {
        if ($serviceGraph->has(EventDispatcherInterface::class) === false) {
            return;
        }

        $eventDispatcherDefinition = $serviceGraph->get(EventDispatcherInterface::class);

        foreach ($serviceGraph->all() as $definition) {
            $hasTag = $definition->hasTag('event_listener');
            $hasPsrImplementation = in_array(
                ListenerProviderInterface::class,
                class_implements(
                    $definition->className,
                ),
                true
            );

            if ($hasTag || $hasPsrImplementation) {
                $eventDispatcherDefinition->addMethodCall(
                    'addListener',
                    [
                        'listener' => Reference::service($definition->id)
                    ]
                );
            }
        }
    }
}