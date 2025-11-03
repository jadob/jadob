<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Exception\UrlGenerationException;
use PHPUnit\Framework\TestCase;



/**
 * @TODO: testFullUrlGeneration* test probably should be one test case with multiple providers - verify it and refactor
 * @group router
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterTest extends TestCase
{
    private function getDummyContext(): RouterContext
    {
        return new RouterContext(
            port: 443,
            secure: true,
            host: 'example.com',
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

    public function testMatchingWildcardRouteOnExistingPathButDifferentMethod(): void
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route(
            name: 'important_method',
            path: '/api/v1/thing',
            handler: 'api_function',
            methods: ['POST']
        ));

        $routeCollection->addRoute(new Route(
            name: 'cors_handler',
            path: '/{any}',
            handler: 'cors_handler',
            methods: ['OPTIONS'],
            pathParameters: [
                'any' => PathParamMatchType::WILDCARD,
            ]
        ));

        $router = new Router(
            $routeCollection,
            $this->getDummyContext(),
        );

        self::assertEquals(
            'cors_handler',
            $router->match('/api/v1/thing', 'OPTIONS')->route->name
        );
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


    public function testFullUrlGenerationWithNoArgumentsDefinedInRouterContextWillCauseAMissingHostException()
    {

        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            new RouterContext()
        );

        $this->expectException(UrlGenerationException::class);
        $this->expectExceptionMessage('Unable to generate path for "example" as the host in context was not provided.');

        $router->generateRoute('example', ['a' => 'b'], true);

    }

    public function testFullUrlGenerationWithPortAndNonSecureDefinedInContext()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            new RouterContext(
                host: 'example.com',
                secure: false,
                port: 8080,
            )
        );


        self::assertEquals(
            'http://example.com:8080/a/b',
            $router->generateRoute('example', ['a' => 'b'], true)
        );
    }

    public function testFullUrlGenerationWithPortAndSecureDefinedInContext()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            new RouterContext(
                host: 'example.com',
                secure: true,
                port: 8080,
            )
        );


        self::assertEquals(
            'https://example.com:8080/a/b',
            $router->generateRoute('example', ['a' => 'b'], true)
        );
    }

    public function testFullUrlGenerationWithHttpsPortAndSecureDefinedInContext()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            new RouterContext(
                host: 'example.com',
                secure: true,
                port: 443,
            )
        );


        self::assertEquals(
            'https://example.com/a/b',
            $router->generateRoute('example', ['a' => 'b'], true)
        );
    }

    public function testFullUrlGenerationWithHttpPortAndNonSecureDefinedInContext()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(new Route('example', '/a/{a}', [], null,  ['POST']));

        $router = new Router(
            $routeCollection,
            new RouterContext(
                host: 'example.com',
                secure: false,
                port: 80,
            )
        );


        self::assertEquals(
            'http://example.com/a/b',
            $router->generateRoute('example', ['a' => 'b'], true)
        );
    }
}