<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\EventManager\ServiceProvider;

use Doctrine\Common\EventManager;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class DoctrineEventManagerServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder->set(EventManager::class);
    }
}