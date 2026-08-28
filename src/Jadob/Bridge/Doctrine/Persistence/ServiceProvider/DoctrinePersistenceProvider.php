<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence\ServiceProvider;

use Doctrine\Persistence\ManagerRegistry;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class DoctrinePersistenceProvider implements ServiceProviderInterface
{
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface $config = null
    ): void {
        $builder
            ->set(DoctrineManagerRegistry::class);

        $builder
            ->bind(
                ManagerRegistry::class,
                DoctrineManagerRegistry::class
            );
    }
}