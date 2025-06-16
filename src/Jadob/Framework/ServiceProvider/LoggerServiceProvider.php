<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use AWS\CRT\Log;
use Jadob\Bridge\Monolog\Configuration\LoggerConfiguration;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Framework\DependencyInjection\Extension\InjectLoggerAutowireExtension;
use Jadob\Framework\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Psr\Log\LogLevel;

class LoggerServiceProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'logger';
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        $services = [];
        $services['jadob.framework.logger_factory'] = function (BootstrapInterface $bootstrap) use ($config): LoggerFactory {
            /**
             * TODO: when defining arguments in DI definitions would be available, refactor this to nod use the factory
             * and use array/definition syntax
             */
            return new LoggerFactory(
                bootstrap: $bootstrap,
                defaultLoggerChannel: $config['default_logger_channel'],
                defaultErrorLoggerChannel: $config['default_error_logger_channel'],
                channelsConfig: $config['channels'],
                handlersConfig: $config['handlers'],
            );
        };

        $services['jadob.framework.logger_extension'] = static function (LoggerFactory $loggerFactory): InjectLoggerAutowireExtension {
            return new InjectLoggerAutowireExtension(
                $loggerFactory
            );
        };

        return $services;
    }

    public function getDefaultConfiguration(): object
    {
        $config = new LoggerConfiguration();

        $config->configureChannel('default', LogLevel::INFO);


        return $config;
    }
}