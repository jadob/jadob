<?php

declare(strict_types=1);

namespace Jadob\Contracts\Framework\Module;

use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

interface ModuleInterface
{
    /**
     * @param string $env
     * @return list<ServiceProviderInterface>
     */
    public function getServiceProviders(string $env): array;

    /**
     * @return array{extension: CompilerExtensionInterface, priority: int}[]
     */
    public function getContainerCompilerExtensions(): array;
}