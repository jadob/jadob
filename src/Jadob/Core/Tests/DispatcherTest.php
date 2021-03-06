<?php

namespace Jadob\Core\Tests;

use Jadob\Container\Container;
use Jadob\Core\Dispatcher;
use Jadob\Core\Exception\KernelException;
use Jadob\Core\RequestContext;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class DispatcherTest
 *
 * @package Jadob\Core\Tests
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DispatcherTest extends TestCase
{

    /**
     * @return void
     */
    public function setUp(): void
    {
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['SERVER_PORT'] = 8000;
    }

    /**
     * @throws KernelException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Jadob\Router\Exception\MethodNotAllowedException
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     * @throws \ReflectionException
     *
     * @return void
     */
    public function testDispatcherWillThrowExceptionIfControllerWillBeNull(): void
    {
        $this->expectException(KernelException::class);
        $this->expectExceptionMessage('Route "example_route_1" should provide a valid FQCN or Closure, null given');

        $container = new Container();

        $invalidRoute = new Route('example_route_1', '/invalid', null);
        $collection = new RouteCollection();

        $collection->addRoute($invalidRoute);

        $router = new Router($collection);
        $container->add('router', $router);

        $request = Request::create('/invalid');

        $dispatcher = new Dispatcher([], $container, new NullLogger(), new EventDispatcher());

        $dispatcher->executeRequest(new RequestContext('test', $request, false));
    }

}