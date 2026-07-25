<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Closure;
use Psr\Container\ContainerInterface;

interface ServiceProviderInterface
{
    /**
     * Configure and register your services here.
     *
     * @param ContainerInterface $container
     * @param array|object|null $config
     * @return array<string|class-string, array|Closure|object>
     */
    public function register(
        ContainerInterface $container,
        array|object|null $config = null
    ): array;
}