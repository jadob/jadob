<?php

namespace Jadob\Core\Tests;

use Jadob\Container\Container;
use Jadob\Core\Dispatcher;
use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package Jadob\Core\Tests
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ExampleController
{

    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response('ok');
    }
}


/**
 * Class DispatcherTest
 *
 * @package Jadob\Core\Tests
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DispatcherTest extends TestCase
{

    public function setUp()
    {

        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['SERVER_PORT'] = 8000;
    }

    /**
     * @expectedException \Jadob\Core\Exception\KernelException
     */
    public function testDispatcherWillThrowExceptionIfControllerWillBeNull()
    {

        $container = new Container();

        $invalidRoute = new Route('example_route_1', '/invalid', null);
        //        $validRouteWithClosure = new Route('example_route_2', '/valid/1', function () {
        //            return new Response('ok');
        //        });
        //
        //        $validRouteWithClass = new Route('example_route_3', '/valid/2', ExampleController::class);


        $collection = new RouteCollection();

        $collection->addRoute($invalidRoute);

        $router = new Router($collection);
        $container->add('router', $router);

        $request = Request::create('/invalid');

        $dispatcher = new Dispatcher($container);

        $dispatcher->executeRequest($request);
    }


}