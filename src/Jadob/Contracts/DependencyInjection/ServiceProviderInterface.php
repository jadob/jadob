<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Jadob\Container\Config\ConfigNodeInterface;

/**
 * Groups related build-time service registrations behind a reusable,
 * stateless package extension point.
 */
interface ServiceProviderInterface
{
    /**
     * Configure and register your services here.
     *
     * @param ContainerBuilderInterface $builder
     * @param ConfigNodeInterface|null $config
     */
    public function register(
        ContainerBuilderInterface $builder,
        ConfigNodeInterface|null $config = null,
    ): void;
}