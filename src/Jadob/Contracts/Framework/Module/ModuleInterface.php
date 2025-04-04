<?php

declare(strict_types=1);

namespace Jadob\Contracts\Framework\Module;

use Jadob\Contracts\DependencyInjection\ContainerExtensionProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

interface ModuleInterface
{
    /**
     * @param string $env
     * @return list<ServiceProviderInterface>
     */
    public function getServiceProviders(string $env): array;

    /**
     * @param string $env
     * @return list<ContainerExtensionProviderInterface>
     */
    public function getContainerExtensionProviders(string $env): array;

    /**
     * @param ContainerInterface $container
     * @param string $env
     * @return list<ListenerProviderInterface>
     */
    public function getEventListeners(ContainerInterface $container, string $env): array;
}