<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence\ServiceProvider;

use Doctrine\Persistence\ManagerRegistry;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class DoctrinePersistenceProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, array|object|null $config = null): array
    {
        return [
            ManagerRegistry::class => static function (): ManagerRegistry {
                return new DoctrineManagerRegistry();
            }
        ];
    }

    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}