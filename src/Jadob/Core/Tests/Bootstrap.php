<?php

namespace Jadob\Core\Tests;

use Jadob\Core\AbstractBootstrap;

/**
 * Class Bootstrap
 *
 * @package Jadob\Core\Tests
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
    public function getServiceProviders(): array
    {
        return [];
    }
}