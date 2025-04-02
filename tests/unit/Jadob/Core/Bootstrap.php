<?php
declare(strict_types=1);

namespace Jadob\Core;


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
     * Returns array of Service providers that will be load while framework bootstrapping.
     *
     * @return array
     */
    public function getServiceProviders(string $env): array
    {
        return [];
    }

    public function getModules(): array
    {
        // TODO: Implement getModules() method.
    }
}