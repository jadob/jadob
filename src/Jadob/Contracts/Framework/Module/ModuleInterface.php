<?php

declare(strict_types=1);

namespace Jadob\Contracts\Framework\Module;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Router\RouteCollection;

interface ModuleInterface
{
    /**
     * @param string $env
     * @return list<ServiceProviderInterface<covariant ConfigNodeInterface|null>>
     */
    public function getServiceProviders(string $env): array;

    /**
     * @return array<int, CompilerExtensionInterface>
     */
    public function getContainerCompilerExtensions(): array;

    public function getRoutes(): ?RouteCollection;
}