<?php

namespace Jadob\Bridge\Doctrine\Common\ServiceProvider;

use Doctrine\Common\EventManager;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class DoctrineCommonServiceProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            EventManager::class => function (): EventManager {
                return new EventManager();
            }
        ];
    }
}