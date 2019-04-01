<?php

namespace Jadob\Router\Tests;

use Jadob\Router\Route;
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
        $route = new Route('example-route-1');

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
        $route = new Route('example-route-2');

        $route
            ->setParams([
                '_param1' => 'value1',
                'param2' => 'value2'
            ]);

        $this->assertCount(2, $route->getParams());
    }

    public function testRouteNameChanging()
    {

        $route = new Route('example-route-3');

        $this->assertEquals('example-route-3', $route->getName());

        $route->setName('example-route-3-v2');

        $this->assertEquals('example-route-3-v2', $route->getName());
    }

    public function testRouteMethods()
    {
        $route = new Route('route-with-many-methods');
        $route->setMethods(Route::METHOD_GET | Route::METHOD_POST);

        $this->assertEquals(3, $route->getMethods());
    }
}