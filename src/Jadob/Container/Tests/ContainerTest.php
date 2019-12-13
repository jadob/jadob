<?php

namespace Jadob\Container\Tests;

use Jadob\Container\Container;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * Class ContainerTest
 *
 * @package Jadob\Container\Tests
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
        $container = new Container(
            [], ['dummy' => function () {
                return new \stdClass();
            }]
        );
        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));
    }

    public function testAccessingFactories()
    {

        $container = new Container(
            ['dummy1' => new \stdClass()], ['dummy2' => function () {
                return new \stdClass();
            }]
        );

        $this->assertTrue($container->has('dummy1'));
        $this->assertTrue($container->has('dummy2'));

        $this->assertNotNull($container->get('dummy1'));
        $this->assertNotNull($container->get('dummy2'));


    }

    /**
     * @expectedException \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function testServiceNotFoundException()
    {
        $container = new Container();

        $container->get('missing');

    }

    public function testContainerIsPsr3Compatible()
    {
        $container = new Container();

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }


    public function testGettingServicesByItsClassName()
    {
        $container = new Container(
            [], ['dummy2' => function () {
                return new DummyClass();
            }]
        );

        $container->add('dummy', new \stdClass());

        $this->assertInstanceOf(Container::class, $container->findObjectByClassName(ContainerInterface::class));
        $this->assertInstanceOf(DummyClass::class, $container->findObjectByClassName(DummyClass::class));
        $this->assertInstanceOf(\stdClass::class, $container->findObjectByClassName(\stdClass::class));
    }
}