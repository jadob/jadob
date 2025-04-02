<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Contracts\ErrorHandler\ErrorHandlerInterface;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\Framework\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

class ErrorHandlerServiceProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function __construct(private string $env)
    {
    }

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            ErrorHandlerInterface::class => function (LoggerFactory $loggerFactory) {
                return HandlerFactory::factory(
                    $this->env,
                    $loggerFactory->getDefaultLogger()
                );
            }
        ];
    }

    public function getParentServiceProviders(): array
    {
        return [
            LoggerServiceProvider::class
        ];
    }
}