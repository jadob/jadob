<?php

namespace Jadob\Container\Tests;

use Jadob\Container\Container;
use PHPUnit\Framework\TestCase;

/**
 * Class ContainerTest
 * @package Jadob\Container\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license proprietary
 */
class ContainerTest extends TestCase
{

    public function testServicesAliasing()
    {

        $container = new Container(['dummy' => new \stdClass()]);
        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));

    }

    public function testFactoriesAliasing()
    {
        $container = new Container([], ['dummy' => function () {
            return new \stdClass();
        }]);
        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));
    }
}