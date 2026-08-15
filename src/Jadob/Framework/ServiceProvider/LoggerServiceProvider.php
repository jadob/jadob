<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\Attribute\InjectTaggedServices;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Framework\DependencyInjection\CompilerExtension\InjectLoggerExtension;
use Jadob\Framework\Logger\HandlerConfiguration;
use Jadob\Framework\Logger\HandlerFactory\RotatingFileHandlerFactory;
use Jadob\Framework\Logger\HandlerFactory\StreamHandlerFactory;
use Jadob\Framework\Logger\LoggerFactory;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use function in_array;

final readonly class LoggerServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    private const string HANDLER_FACTORY_TAG = 'logger.handler_factory';

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
                fn(
                    #[InjectTaggedServices(self::HANDLER_FACTORY_TAG)] array $handlerFactories
                ): LoggerFactory => new LoggerFactory(
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
                    handlerFactories: $handlerFactories
                )
            );

        $this->registerLoggerHandlerFactories(
            builder: $builder,
            handlerTypes: array_unique(
                array_values(
                    array_map(
                        fn(LoggerHandlerConfig $handlerConfig): string => $handlerConfig->type,
                        $config->handlers
                    )
                )
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

    private function registerLoggerHandlerFactories(
        ContainerBuilderInterface $builder,
        array                     $handlerTypes
    ): void
    {
        if (in_array('rotating_file', $handlerTypes)) {
            $builder
                ->set(RotatingFileHandlerFactory::class)
                ->withTag(self::HANDLER_FACTORY_TAG);
        }

        if (in_array('stream', $handlerTypes)) {
            $builder
                ->set(StreamHandlerFactory::class)
                ->withTag(self::HANDLER_FACTORY_TAG);
        }

    }
}