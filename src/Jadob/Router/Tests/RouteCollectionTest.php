<?php

namespace Jadob\Router\Tests;

use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class RouteCollectionTest
 * @package Jadob\Router\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class RouteCollectionTest extends TestCase
{

    public function testRouteCollectionPassesPrefixAndPathToAllRoutes()
    {
        $collection = new RouteCollection('/nice', 'example.com');
        $collection->addRoute(new Route('test_route_1', '/route1'));

        $this->assertEquals('/nice/route1', $collection['test_route_1']->getPath());
        $this->assertEquals('example.com', $collection['test_route_1']->getHost());
    }


    public function testRouteCollectionNesting()
    {

        $collection1 = new RouteCollection('/r1');
        $collection1->addRoute(new Route('route_1', '/resource.html'));

        $collection2 = new RouteCollection('/r2');
        $collection2->addCollection($collection1);

        $collection3 = new RouteCollection('/r3');
        $collection3->addCollection($collection2);


        $this->assertEquals($collection3['route_1']->getPath(), '/r3/r2/r1/resource.html');
        $this->assertSame($collection3, $collection2->getParentCollection());
        $this->assertSame($collection2, $collection1->getParentCollection());
       // $this->assertNull($collection1->getParentCollection());
    }

    public function testCreatingRouteCollectionFromArray()
    {
        $routes = [
            [
                'path' => '/my/path/1',
                'name' => 'my_example_path',
                'controller' => '/My/Dummy/ControllerClass',
                'action' => 'indexAction',
                'methods' => ['GET', 'POST']
            ],
            [
                'path' => '/my/path/2',
                'name' => 'my_example_path2',
                'controller' => '/My/Dummy/ControllerClass',
                'action' => 'indexAction2',
                'methods' => ['GET', 'POST']
            ],
            [
                'path' => '/my/path/3',
                'name' => 'my_example_path3',
                'controller' => '/My/Dummy/ControllerClass',
                'action' => 'indexAction2',
                'methods' => ['GET', 'POST']
            ],
            [
                'path' => '/my/path/4',
                'name' => 'my_example_path4',
                'controller' => '/My/Dummy/ControllerClass',
                'action' => 'indexAction2',
                'methods' => ['GET', 'POST']
            ],
        ];

        $routeCollection = RouteCollection::fromArray($routes);

        $this->assertInstanceOf(Route::class, $routeCollection['my_example_path4']);
        $this->assertEquals(4, $routeCollection->count());
    }
}