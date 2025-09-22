<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Exception\UrlGenerationException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\assertEquals;

/**
 * @group router
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterTest extends TestCase
{
    private function getDummyContext(): RouterContext
    {
        return new RouterContext(
            host: 'example.com',
            secure: true,
            port: 443,
            basePath: '/',
        );
    }

    public function testMethodNotAllowed(): void
    {

        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('get_user_stuff', '/user/{id}/stuff', [], null,  ['POST']));
        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );


        $this->expectException(MethodNotAllowedException::class);
        $router->match('/user/1/stuff', 'GET');
    }

    public function testMatchingStaticRoutes(): void
    {
        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('example', '/user', [], null, ['GET']));
        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );


        $result = $router->match('/user', 'GET');

        self::assertEquals('example', $result->route->name);
        self::assertCount(0, $result->pathParameters);
    }

    public function testMatchingRouteWithMultiplePathParameters(): void
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/{a}/{b}/{c}/{d}/{e}', [], null, ['GET']));
        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );


        $result = $router->match('/a/b/c/d/e', 'GET');

        self::assertEquals('example', $result->route->name);
        self::assertCount(5, $result->pathParameters);
        self::assertEquals('a', $result->pathParameters['a']);
        self::assertEquals('b', $result->pathParameters['b']);
        self::assertEquals('c', $result->pathParameters['c']);
        self::assertEquals('d', $result->pathParameters['d']);
        self::assertEquals('e', $result->pathParameters['e']);
    }

    public function testRouterPrecedence(): void
    {
        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('example', '/hello', [], null, ['GET']));
        $routeCollection->addRoute(new Route('example2', '/hello', [], null, ['GET']));
        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );

        $result = $router->match('/hello', 'GET');

        self::assertEquals('example', $result->route->name);
    }

    public function testWildcardRoutes(): void
    {
        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(
            new Route(
                'wildcard',
                '/{any}',
                [],
                null,
                ['GET'],
                pathParameters: [
                    'any' => PathParamMatchType::WILDCARD
                ]
            ));

        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );

        $result = $router->match('/hello_world', 'GET');

        self::assertEquals('wildcard', $result->route->name);
        self::assertEquals('hello_world', $result->pathParameters['any']);
    }

    public function testHandlingRouteNotFound(): void
    {
        $routeCollection = new RouteCollection();

        $routeCollection->addRoute(new Route('example', '/user', [], null,  ['POST']));
        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );

        $this->expectException(RouteNotFoundException::class);
        $router->match('/users', 'GET');
    }


    public function testUrlGenerationForStaticRoutes(): void
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/user', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );

        self::assertEquals('/user', $router->generateRoute('example'));
    }

    public function testUrlGenerationForRoutesWillPutParametersToQueryStringWhenNotDefinedInPath(): void
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );

        self::assertEquals(
            '/a/123?b=4',
            $router->generateRoute('example', [
                'a' => '123',
                'b' => '4'
            ])
        );
    }

    public function testUrlGenerationWillThrowAnExceptionWhenNoRequiredParameterWasPassed(): void
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );


        $this->expectException(UrlGenerationException::class);
        $this->expectExceptionMessage('Unable to generate path "example": missing "a" param');
        self::assertEquals(
            '/a/123?b=4',
            $router->generateRoute('example')
        );
    }
}