<?php

namespace Jadob\Router\Tests;

use Jadob\Router\Context;
use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use PHPUnit\Framework\TestCase;

/**
 * Class RouterTest
 * @package Jadob\Router\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class RouterTest extends TestCase
{

    public function testRouterInstanceCreatedWithoutContextWillMakeHisOwnContextFromSuperglobals()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 8001;

        $collection = new RouteCollection();
        $router = new Router($collection);

        $this->assertInstanceOf(Context::class, $router->getContext());
        $this->assertEquals('my.domain.com', $router->getContext()->getHost());
    }

    public function testRouterContextOverriding()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 8001;

        $customContext = new Context();
        $customContext->setHost('my.newdomain.com');
        $collection = new RouteCollection();
        $router = new Router($collection, Context::fromGlobals());


        $this->assertEquals('my.domain.com', $router->getContext()->getHost());
        $router->setContext($customContext);

        $this->assertInstanceOf(Context::class, $router->getContext());
        $this->assertEquals('my.newdomain.com', $router->getContext()->getHost());
    }


    public function testRoutesMatching()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 8001;


        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);
        $result = $router->matchRoute('/user/1/stuff', 'GET');

        $this->assertInstanceOf(Route::class, $result);
    }

}