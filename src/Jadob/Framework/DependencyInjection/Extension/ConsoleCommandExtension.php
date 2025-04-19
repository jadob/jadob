<?php

namespace Jadob\Framework\DependencyInjection\Extension;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Symfony\Component\Console\Application;

class ConsoleCommandExtension implements ContainerExtensionInterface
{

    public function onContainerBuild(Container $container): void
    {
        if(!$container->has(Application::class)) {
            return;
        }

        /** @var Application $console */
        $console = $container->get(Application::class);

        foreach ($container->getTaggedServices('console.command') as $command) {
            $console->add($command);
        }
    }
}