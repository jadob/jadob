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

    public function testParentCollectionIsAssignedToRouteWhenRouteIsAttachedToCollection(): void
    {
        $collection = new RouteCollection();
        $collection->addRoute($route = new Route('example1', '/', 'handler_function'));
        $this->assertSame($collection, $route->parentCollection);
    }

    public function testCreatingRouteFromArray(): void
    {
        $route = [
            'path' => '/my/path/1',
            'name' => 'my_example_path',
            'handler' => 'handler_function',
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

    public function testRouteWillPreventFromMistakingMethodWithMethods(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Invalid key "method". Did you mean "methods"?');

        Route::fromArray([
            'method' => 'GET'
        ]);
    }

    //testRouteWithHostCannotBeAddedToCollection
    //testRouteAttachedToCollectionWithHostWillBeUsingCollectionsHost

}