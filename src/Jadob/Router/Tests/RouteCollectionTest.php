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
    }

}