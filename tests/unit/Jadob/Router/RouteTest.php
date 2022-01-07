<?php

namespace Jadob\Router;

use Jadob\Router\Exception\RouterException;
use LogicException;
use PHPUnit\Framework\TestCase;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouteTest extends TestCase
{

    public function testBasicRouteFeatures(): void
    {
        $route = new Route('example-route-1', '/');

        $route
            ->setController('App\Controller\ApplicationController')
            ->setAction('hello')
            ->setPath('/path/1/2/3')
            ->setParams(
                [
                    '_param1' => 'value1',
                    'param2' => 'value2'
                ]
            );

        $this->assertEquals('example-route-1', $route->getName());
        $this->assertEquals('hello', $route->getAction());
        $this->assertEquals('App\Controller\ApplicationController', $route->getController());
        $this->assertEquals('/path/1/2/3', $route->getPath());


    }


    public function testRouteParams(): void
    {
        $route = new Route('example-route-2', '/');

        $route
            ->setParams(
                [
                    '_param1' => 'value1',
                    'param2' => 'value2'
                ]
            );

        $this->assertCount(2, $route->getParams());
    }

    public function testRouteNameChanging(): void
    {

        $route = new Route('example-route-3', '/');

        $this->assertEquals('example-route-3', $route->getName());

        $route->setName('example-route-3-v2');

        $this->assertEquals('example-route-3-v2', $route->getName());
    }

    public function testRouteMethods(): void
    {
        $route = new Route('route-with-many-methods', '/');
        $route->setMethods(['GET', 'POST']);

        $this->assertCount(2, $route->getMethods());
    }

    public function testParentCollection(): void
    {
        $collection = new RouteCollection();
        $collection->addRoute($route = new Route('example1', '/'));
        $this->assertSame($collection, $route->getParentCollection());
    }

    public function testCreatingRouteFromArray(): void
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

    public function testCreatingRouteFromArrayWillBreakIfNoNamePassed(): void
    {
        $this->expectExceptionMessage('Missing "name" key in $data.');
        $this->expectException(\Jadob\Router\Exception\RouterException::class);
        $route = [
            'path' => '/my/path/1',
            'controller' => '/My/Dummy/ControllerClass',
            'action' => 'indexAction',
            'methods' => ['GET', 'POST']
        ];

        Route::fromArray($route);

    }

    public function testCreatingRouteFromArrayWillBreakIfNoPathPassed(): void
    {
        $this->expectException(\Jadob\Router\Exception\RouterException::class);
        $this->expectExceptionMessage('Missing "path" key in $data.');
        $route = [
            'name' => '/my/path/1',
            'controller' => '/My/Dummy/ControllerClass',
            'action' => 'indexAction',
            'methods' => ['GET', 'POST']
        ];

        Route::fromArray($route);
    }

    public function testRouteWillPreventFromMistakingMethodWithMethods()
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Invalid key "method". Did you mean "methods"?');

        Route::fromArray([
            'method' => 'GET'
        ]);
    }
}