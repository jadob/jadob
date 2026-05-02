<?php
declare(strict_types=1);

namespace Jadob\Framework\DependencyInjection\Extension;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

final readonly class ConsoleCommandExtension implements ContainerExtensionInterface
{
    public function onContainerBuild(Container $container): void
    {
        if (!$container->has(Application::class)) {
            return;
        }

        /** @var Application $console */
        $console = $container->get(Application::class);

        /** @var Command[] $commands */
        $commands = $container->getTaggedServices('console.command');

        foreach ($commands as $command) {
            if (method_exists($console, 'addCommand')) {
                $console->addCommand($command);
            } else {
                $console->add($command);
            }
        }
    }
}