<?php

namespace Jadob\Bridge\Twig\Tests\ServiceProvider;


use Jadob\Core\AbstractBootstrap;

/**
 * @internal
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class Bootstrap extends AbstractBootstrap
{

    /**
     * Returns project root directory.
     *
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
}