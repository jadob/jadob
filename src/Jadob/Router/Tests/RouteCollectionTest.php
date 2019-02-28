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
}