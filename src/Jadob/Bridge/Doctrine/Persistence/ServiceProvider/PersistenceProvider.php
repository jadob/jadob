<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence\ServiceProvider;


use Doctrine\Persistence\ManagerRegistry;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class PersistenceProvider implements ServiceProviderInterface
{

    public function getConfigNode()
    {
        return null;
    }

    public function register($config)
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