<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

interface ServiceProviderInterface
{
    /**
     * Configure and register your services here.
     *
     * @param ContainerInterface $container
     * @param ConfigNode|null $config
     */
    public function register(
        ContainerBuilderInterface $builder,
        ConfigNode|null $config = null,
    ): void;
}