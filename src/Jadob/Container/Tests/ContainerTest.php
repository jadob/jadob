<?php

namespace Jadob\Container\Tests;

use Jadob\Container\Container;
use Jadob\Container\Tests\Fixtures\AService;
use Jadob\Container\Tests\Fixtures\CService;
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

    public function testServicesAliasing(): void
    {

        $container = new Container(['dummy' => new \stdClass()]);
        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));

    }

    public function testFactoriesAliasing(): void
    {
        $container = new Container(
            [], ['dummy' => function () {
                return new \stdClass();
            }]
        );
        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));
    }

    public function testAccessingFactories(): void
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

    public function testServiceNotFoundException(): void
    {
        $this->expectException(\Jadob\Container\Exception\ServiceNotFoundException::class);
        $this->expectExceptionMessage('Service missing is not found in container.');
        $container = new Container();

        $container->get('missing');

    }

    public function testContainerIsPsr11Compatible(): void
    {
        $container = new Container();

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }


    public function testGettingServicesByItsClassName(): void
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

    //
    public function testContainerCanAutowireClassWithKnownDepedencies()
    {
        $container = new Container();
        $container->add(AService::class, new AService());
        $serviceC = $container->autowire(CService::class);

        $this->assertSame($container->get(AService::class), $serviceC->getService());
    }
}