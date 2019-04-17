<?php

namespace Jadob\Core\Tests;

use Jadob\Container\Container;
use Jadob\Core\Exception\KernelException;
use Jadob\Core\Kernel;
use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package Jadob\Core\Tests
 * @author pizzaminded <miki@appvende.net>
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
 * @package Jadob\Core\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DispatcherTest extends TestCase
{

    /**
     * @throws KernelException
     * @throws \Exception
     */
    public function testDispatcherWillExecuteOnlyClassesAndClosures()
    {
        $container = new Container();


        $invalidRoute = new Route('example_route_1', '/invalid', null);
        $validRouteWithClosure = new Route('example_route_2', '/valid/1', function () {
            return new Response('ok');
        });

        $validRouteWithClass = new Route('example_route_3', '/valid/2', ExampleController::class);


        $collection = new RouteCollection();

        $collection->addRoute($invalidRoute)->addRoute($validRouteWithClosure)->addRoute($validRouteWithClass);




    }
}