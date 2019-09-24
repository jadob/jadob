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

    public function setUp()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 8001;
    }

    public function testRouterInstanceCreatedWithoutContextWillMakeHisOwnContextFromSuperglobals(): void
    {
        $collection = new RouteCollection();
        $router = new Router($collection);

        //$this->assertInstanceOf(Context::class, $router->getContext());
        $this->assertEquals('my.domain.com', $router->getContext()->getHost());
    }

    public function testRouterContextOverriding()
    {
        $customContext = new Context();
        $customContext->setHost('my.newdomain.com');
        $collection = new RouteCollection();
        $router = new Router($collection, Context::fromGlobals());


        $this->assertEquals('my.domain.com', $router->getContext()->getHost());
        $router->setContext($customContext);

        //$this->assertInstanceOf(Context::class, $router->getContext());
        $this->assertEquals('my.newdomain.com', $router->getContext()->getHost());
    }


//    public function testRoutesMatching()
//    {
//        $routeCollection = new RouteCollection();
//
//        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
//        $router = new Router($routeCollection);
//        $result = $router->matchRoute('/user/1/stuff', 'GET');
//
//        $this->assertInstanceOf(Route::class, $result);
//    }

    /**
     * @expectedException \Jadob\Router\Exception\MethodNotAllowedException
     */
    public function testMethodNotAllowed(): void
    {
        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff', null, null, null, ['POST']));
        $router = new Router($routeCollection);

        $router->matchRoute('/user/1/stuff', 'GET');

    }

    public function testRouterWillMatchHostNames(): void
    {
        $routeCollection = new RouteCollection(
            null,
            'my.domain.com'
        );

        $routeCollection->addRoute(new Route(
            'get_user_stuff',
            '/user/{id}/stuff'

        ));

        $routeCollection->addRoute(new Route(
            'get_user_stuff2',
            '/user/{id}/stuff2'

        ));
        $router = new Router($routeCollection);
        $result = $router->matchRoute('/user/1/stuff', 'GET');

        $this->assertEquals('get_user_stuff', $result->getName());
    }


    public function testRouteGenerating(): void
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);


        $this->assertEquals('/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2]));

    }

    public function testFullRouteWithHttpAndCustomPortGenerating(): void
    {

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        $this->assertEquals('http://my.domain.com:8001/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));


    }

    public function testFullRouteWithHttpAndDefaultPortGenerating(): void
    {

        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 80;

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        $this->assertEquals('http://my.domain.com/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));


    }

    public function testFullRouteWithHttpsAndCustomPortGenerating(): void
    {

        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 9876;
        $_SERVER['HTTPS'] = 'on';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        $this->assertEquals('https://my.domain.com:9876/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));
    }

    public function testFullRouteWithHttpsAndDefaultPortGenerating(): void
    {

//        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 443;
        $_SERVER['HTTPS'] = 'on';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        $this->assertEquals('https://my.domain.com/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));

    }

    public function testFullRouteWithHttpAndHttpsPortGenerating(): void
    {

//        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 443;
//        $_SERVER['HTTPS'] = 'on';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        $this->assertEquals('http://my.domain.com:443/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));

    }

}