<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\CommandBus\ServiceProvider;

use Closure;
use Jadob\Container\Container;
use Jadob\Container\LazyInvokableClass;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\EventSourcing\CommandBus\CommandBus;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class CommandBusProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigNode()
    {
        return 'command_bus';
    }

    /**
     * {@inheritDoc}
     *
     * @return Closure[]
     *
     * @psalm-return array{Jadob\EventSourcing\CommandBus\CommandBus: \Closure(ContainerInterface):CommandBus}
     */
    public function register($config)
    {
        return [
            CommandBus::class => static function (ContainerInterface $container) use ($config) {
                $separateLogger = true;
                if (isset($config['separate_logger'])) {
                    $separateLogger = (bool) $config['separate_logger'];
                }

                if ($separateLogger) {
                    $logDir = $container->get(BootstrapInterface::class)->getLogsDir() . '/command_bus.log';
                    $stream = new StreamHandler($logDir);
                    $logger = new Logger('command_bus', [$stream]);
                } else {
                    $logger = $container->get(LoggerInterface::class);
                }

                return new CommandBus($logger);
            }
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        if (isset($config['mapping'])) {
            $mapping = $config['mapping'];

            if (!\is_array($mapping)) {
                throw new RuntimeException('Mapping in command bus should be an array.');
            }

            $commandBus = $container->get(CommandBus::class);
            foreach ($mapping as $command => $handler) {
                $commandBus->addRoute($command, new LazyInvokableClass($container, $handler));
            }
        }
    }
}