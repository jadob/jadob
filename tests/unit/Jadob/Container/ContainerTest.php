<?php

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerLockedException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\Fixtures\AService;
use Jadob\Container\Fixtures\CService;
use Jadob\Container\Fixtures\ExampleService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use stdClass;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license proprietary
 */
class ContainerTest extends TestCase
{

    public function testServicesAliasing(): void
    {

        $container = new Container(['dummy' => new stdClass()]);
        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));

    }

    public function testFactoriesAliasing(): void
    {
        $container = new Container(
            ['dummy' => function () {
                return new stdClass();
            }]
        );

        $container->alias('dummy', 'dummy1');

        $this->assertSame($container->get('dummy'), $container->get('dummy1'));
    }


    public function testServiceNotFoundException(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage('Service "missing" is not found in container.');
        $container = new Container();

        $container->get('missing');

    }

    public function testContainerLocking(): void
    {
        $this->expectException(ContainerLockedException::class);
        $this->expectExceptionMessage('Could not add any services as container is locked.');
        $container = new Container();
        $container->lock();

        $container->add('service', new ExampleService());
    }

    public function testContainerIsPsr11Compatible(): void
    {
        $container = new Container();

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }


    /**
     * @group container
     * @group container-find-by-fqcn
     * @return void
     * @throws ContainerLockedException
     * @throws Exception\ContainerException
     * @throws \ReflectionException
     */
    public function testGettingServicesByItsClassName(): void
    {
        $container = new Container(
            ['dummy2' => function () {
                return new DummyClass();
            }]
        );

        $container->add('dummy', new stdClass());

        $this->assertInstanceOf(Container::class, $container->findObjectByClassName(ContainerInterface::class));
        $this->assertInstanceOf(DummyClass::class, $container->findObjectByClassName(DummyClass::class));
        $this->assertInstanceOf(AService::class, $container->findObjectByClassName(AService::class));
    }


    public function testContainerCanAutowireClassWithKnownDependencies()
    {
        $container = new Container();
        $container->add(AService::class, new AService());
        $serviceC = $container->autowire(CService::class);

        $this->assertSame($container->get(AService::class), $serviceC->getService());
    }

    /**
     * @throws ContainerLockedException
     * @throws Exception\ContainerException
     * @throws ServiceNotFoundException
     */
    public function testGetWillAutowireServiceIfPresentInDefinitions()
    {
        $container = new Container();
        $container->add(AService::class, AService::class);
        $service = $container->get(AService::class);
        self::assertIsObject($service);
    }
}