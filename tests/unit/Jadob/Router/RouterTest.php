<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\MethodNotAllowedException;
use PHPUnit\Framework\TestCase;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterTest extends TestCase
{

    /**
     * @return void
     */
    public function setUp(): void
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 8001;
    }

    public function testRouterInstanceCreatedWithoutContextWillMakeHisOwnContextFromSuperglobals(): void
    {
        $collection = new RouteCollection();
        $router = new Router($collection);

        self::assertEquals('my.domain.com', $router->getContext()->getHost());
    }

    public function testRouterContextOverriding(): void
    {
        $customContext = new Context();
        $customContext->setHost('my.newdomain.com');
        $collection = new RouteCollection();
        $router = new Router($collection, Context::fromGlobals());


        self::assertEquals('my.domain.com', $router->getContext()->getHost());
        $router->setContext($customContext);

        self::assertEquals('my.newdomain.com', $router->getContext()->getHost());
    }


    public function testMethodNotAllowed(): void
    {
        $this->expectException(\Jadob\Router\Exception\MethodNotAllowedException::class);
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

        $routeCollection->addRoute(
            new Route(
                'get_user_stuff',
                '/user/{id}/stuff'
            )
        );

        $routeCollection->addRoute(
            new Route(
                'get_user_stuff2',
                '/user/{id}/stuff2'
            )
        );
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
    public function testFullRouteWithHttpAndDefaultPortGenerating(): void
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = '80';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        self::assertEquals('http://my.domain.com/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));


    }

    public function testFullRouteWithHttpsAndCustomPortGenerating(): void
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = '9876';
        $_SERVER['HTTPS'] = 'on';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        self::assertEquals('https://my.domain.com:9876/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));
    }

    public function testFullRouteWithHttpsAndDefaultPortGenerating(): void
    {
        $_SERVER['SERVER_PORT'] = '443';
        $_SERVER['HTTPS'] = 'on';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        self::assertEquals('https://my.domain.com/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));

    }

    public function testFullRouteWithHttpAndHttpsPortGenerating(): void
    {
        $_SERVER['SERVER_PORT'] = '443';

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection);

        self::assertEquals('http://my.domain.com:443/user/2/stuff', $router->generateRoute('get_user_stuff', ['id' => 2], true));

    }

    public function testPathGenerationWithNonNullAlias()
    {
        $context = Context::fromBaseUrl('https://evil.corp/_api');
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff'));
        $router = new Router($routeCollection, $context);

        self::assertEquals('/_api/user/5/stuff', $router->generateRoute('get_user_stuff', ['id' => 5]));
    }

    public function testMultipleMethodsOnTheSamePath(): void
    {
        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('pet_remove', '/pets', null, null, null, ['DELETE']));
        $routeCollection->addRoute(new Route('pet_add', '/pets', null, null, null, ['POST']));
        $routeCollection->addRoute(new Route('pet_list', '/pets', null, null, null, ['GET']));
        $router = new Router($routeCollection);

        $route = $router->matchRoute('/pets', 'POST');

        self::assertEquals('pet_add', $route->getName());
    }

    public function testMultipleMethodsOnTheSamePathButThereIsAnotherOneInRequest(): void
    {
        self::expectException(MethodNotAllowedException::class);

        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('pet_add', '/pets', null, null, null, ['POST']));
        $routeCollection->addRoute(new Route('pet_list', '/pets', null, null, null, ['GET']));
        $router = new Router($routeCollection);

        $router->matchRoute('/pets', 'PATCH');
    }
}