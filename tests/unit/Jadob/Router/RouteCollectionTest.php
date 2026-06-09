<?php
declare(strict_types=1);

namespace Jadob\Router;

use PHPUnit\Framework\TestCase;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouteCollectionTest extends TestCase
{
    public function testRouteCollectionPassesPrefixAndPathToAllRoutes(): void
    {
        $collection = new RouteCollection('/nice', 'example.com');
        $collection->addRoute(new Route('test_route_1', '/route1', 'sample_handler'));

        self::assertEquals('/nice/route1', $collection['test_route_1']->getPath());
        self::assertEquals('example.com', $collection['test_route_1']->getHost());
    }


    public function testRouteCollectionNesting(): void
    {
        $collection1 = new RouteCollection('/r1');
        $collection1->addRoute(new Route('route_1', '/resource.html', 'sample_handler'));

        $collection2 = new RouteCollection('/r2');
        $collection2->merge($collection1);

        $collection3 = new RouteCollection('/r3');
        $collection3->merge($collection2);


        self::assertEquals('/r3/r2/r1/resource.html', $collection3['route_1']->getPath());
        self::assertSame($collection3, $collection2->getParentCollection());
        self::assertSame($collection2, $collection1->getParentCollection());
    }

    public function testCreatingRouteCollectionFromArray(): void
    {
        $routes = [
            [
                'path' => '/my/path/1',
                'name' => 'my_example_path',
                'handler' => 'handler_function',
                'methods' => ['GET', 'POST']
            ],
            [
                'path' => '/my/path/2',
                'name' => 'my_example_path2',
                'handler' => 'handler_function',
                'methods' => ['GET', 'POST']
            ],
            [
                'path' => '/my/path/3',
                'name' => 'my_example_path3',
                'handler' => 'handler_function',
                'methods' => ['GET', 'POST']
            ],
            [
                'path' => '/my/path/4',
                'name' => 'my_example_path4',
                'handler' => 'handler_function',
                'methods' => ['GET', 'POST']
            ],
        ];

        $routeCollection = RouteCollection::fromArray($routes);

        self::assertInstanceOf(Route::class, $routeCollection['my_example_path4']);
        self::assertEquals(4, $routeCollection->count());
    }
}