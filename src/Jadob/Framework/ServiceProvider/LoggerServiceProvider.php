<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Framework\DependencyInjection\CompilerExtension\InjectLoggerExtension;
use Jadob\Framework\Logger\HandlerConfiguration;
use Jadob\Framework\Logger\LoggerFactory;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class LoggerServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getConfigNode(): string
    {
        return 'logger';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param LoggerConfig $config
     * @return void
     */
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder
            ->set(LoggerFactory::class)
            ->withFactory(
                fn(): LoggerFactory => new LoggerFactory(
                    defaultLoggerChannel: $config->defaultLoggerChannel,
                    defaultErrorLoggerChannel: $config->defaultErrorLoggerChannel,
                    channelsConfig: $config->channels,
                    handlersConfig: array_map(
                        fn(LoggerHandlerConfig $handlerConfig): HandlerConfiguration => new HandlerConfiguration(
                            type: $handlerConfig->type,
                            level: $handlerConfig->level,
                            channels: $handlerConfig->channels,
                            parameters: $handlerConfig->parameters,
                        ),
                        $config->handlers
                    ),
                )
            );
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        $config = new LoggerConfig();

        $config
            ->withDefaultErrorLoggerChannel('error')
            ->withDefaultLoggerChannel('default')
            ->withLoggerChannel('dispatcher')
            ->configureStreamHandler(
                handlerName: 'stderr',
                channels: ['error'],
                level: Logger::ERROR,
                stream: 'php://stderr',
            )
            ->configureStreamHandler(
                handlerName: 'stdout',
                channels: ['default', 'dispatcher'],
                level: Logger::INFO,
                stream: 'php://stdout',
            );

        return $config;
    }
}