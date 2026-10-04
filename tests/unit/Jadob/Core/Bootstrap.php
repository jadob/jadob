<?php
declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Bootstrap extends AbstractBootstrap
{
    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return __DIR__;
    }

    /**
     * @param string $env
     * @return list<ServiceProviderInterface<covariant ConfigNodeInterface>>
     */
    public function getServiceProviders(string $env): array
    {
        return [];
    }

    public function getModules(): array
    {
        return [];
    }
}