<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Contracts\ErrorHandler\ErrorHandlerInterface;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\Framework\Logger\LoggerFactory;

class ErrorHandlerServiceProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function __construct(private string $env)
    {
    }


    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder->set(HandlerFactory::class)
            ->factory(
                function (LoggerFactory $loggerFactory) {
                    return HandlerFactory::factory(
                        $this->env,
                        $loggerFactory->getDefaultLogger()
                    );
                }
            );

        $builder->bind(ErrorHandlerInterface::class, HandlerFactory::class);
    }

    public function getParentServiceProviders(): array
    {
        return [
            LoggerServiceProvider::class
        ];
    }
}