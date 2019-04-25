<?php

namespace Jadob\Router\Tests;

use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class RouteTest
 * @package Jadob\Router\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class RouteTest extends TestCase
{

    public function testBasicRouteFeatures()
    {
        $route = new Route('example-route-1', '/');

        $route
            ->setController('App\Controller\ApplicationController')
            ->setAction('hello')
            ->setPath('/path/1/2/3')
            ->setParams([
                '_param1' => 'value1',
                'param2' => 'value2'
            ]);

        $this->assertEquals('example-route-1', $route->getName());
        $this->assertEquals('hello', $route->getAction());
        $this->assertEquals('App\Controller\ApplicationController', $route->getController());
        $this->assertEquals('/path/1/2/3', $route->getPath());


    }


    public function testRouteParams()
    {
        $route = new Route('example-route-2', '/');

        $route
            ->setParams([
                '_param1' => 'value1',
                'param2' => 'value2'
            ]);

        $this->assertCount(2, $route->getParams());
    }

    public function testRouteNameChanging()
    {

        $route = new Route('example-route-3', '/');

        $this->assertEquals('example-route-3', $route->getName());

        $route->setName('example-route-3-v2');

        $this->assertEquals('example-route-3-v2', $route->getName());
    }

    public function testRouteMethods()
    {
        $route = new Route('route-with-many-methods', '/');
        $route->setMethods(['GET', 'POST']);

        $this->assertCount(2, $route->getMethods());
    }

    public function testParentCollection()
    {
        $collection = new RouteCollection();
        $collection->addRoute($route = new Route('example1', '/'));
        $this->assertSame($collection, $route->getParentCollection());
    }

    public function testCreatingRouteFromArray()
    {
        $route = [
            'path' => '/my/path/1',
            'name' => 'my_example_path',
            'controller' => '/My/Dummy/ControllerClass',
            'action' => 'indexAction',
            'methods' => ['GET', 'POST']
        ];

        $routeObject = Route::fromArray($route);

        $this->assertEquals('/my/path/1', $routeObject->getPath());
    }

    /**
     * @expectedException \Jadob\Router\Exception\RouterException
     * @expectedExceptionMessage Missing "name" key in $data.
     * @throws \Jadob\Router\Exception\RouterException
     */
    public function testCreatingRouteFromArrayWillBreakIfNoNamePassed()
    {
        $route = [
            'path' => '/my/path/1',
            'controller' => '/My/Dummy/ControllerClass',
            'action' => 'indexAction',
            'methods' => ['GET', 'POST']
        ];

        Route::fromArray($route);

    }

    /**
     * @expectedException \Jadob\Router\Exception\RouterException
     * @expectedExceptionMessage Missing "path" key in $data.
     * @throws \Jadob\Router\Exception\RouterException
     */
    public function testCreatingRouteFromArrayWillBreakIfNoPathPassed()
    {
        $route = [
            'name' => '/my/path/1',
            'controller' => '/My/Dummy/ControllerClass',
            'action' => 'indexAction',
            'methods' => ['GET', 'POST']
        ];

        Route::fromArray($route);
    }
}