<?php

declare(strict_types=1);

namespace Jadob\Micro;

use Closure;
use Jadob\Container\ContainerBuilder;
use Jadob\Http\Middleware\DispatcherMiddleware;
use Jadob\Http\Middleware\ErrorHandlerMiddleware;
use Jadob\Http\Middleware\LoggerMiddleware;
use Jadob\Http\Server\RequestHandler;
use Jadob\Router\Context;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function array_merge;
use function count;
use function get_class;
use function is_array;
use function is_string;
use function spl_object_hash;

/**
 * Express style microframework kernel.
 * If you want to quickly create APIs or microservices, this one will be better than creating app using Jadob\Core\Kernel.
 *
 * Jadob\Micro is an boilerplate which allows you to create things without being worried about configuration, defining
 * service providers. Everything is pre-composed.
 *
 * Which features arent included in Micro?
 * - Path generator - you pass only path, methods, and callback. you have to generate routes by yourself.
 * - Bootstrap class it is not needed here.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @see     docs/components/micro/introduction.md
 * @license MIT
 */
class Micro /**
* implements \ArrayAccess 
**/
{
    /**
     * Micro uses the same codebase as Jadob so both will have the same versions.
     *
     * @var string
     */
    public const VERSION = '0.1.3';

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @var string (dev|prod)
     */
    protected $enviroment = 'prod';

    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares = [];

    /**
     * @var array[]
     */
    protected $config = [];

    /**
     * @var array<string,string>
     */
    protected $middlewarePrefixes = [];

    /**
     * @var array
     */
    protected $services;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->container = null; //Typed property must not be accessed before initialization
        $this->containerBuilder = new ContainerBuilder();

        if (!isset($config['providers'])) {
            $config['providers'] = [];
        }

        if (!isset($config['services'])) {
            $config['services'] = [];
        }

        $this->config = $config;

        $this->containerBuilder->setServiceProviders($config['providers']);
        foreach ($config['services'] as $serviceName => $service) {
            $this->containerBuilder->add($serviceName, $service);
        }

        $this->enviroment = $config['env'] ?? 'prod';
        $this->services = $config['services'] ?? [];
        $this->router = new Router(new RouteCollection(), Context::fromGlobals());
    }

    public function get($path, $callback): self
    {
        $route = new Route($path, $path);
        $route->setController($callback);
        $route->setMethods(['GET']);

        $this->router->getRouteCollection()->addRoute($route);

        return $this;
    }

    /**
     * @param  string     $path    URI for current action
     * @param  callable   $action  Controller that will be called after all middlewares
     * @param  array|null $methods HTTP Methods that action supports (if omitted, route will be matched for all)
     * @return Micro
     */
    public function addRoute(string $path, callable $action, ?array $methods = [])
    {
        if (count($methods) === 0) {
            $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
        }

        $route = new Route($path, $path);
        $route->setController($action);
        $route->setMethods($methods);
        $this->router->getRouteCollection()->addRoute($route);

        return $this;

    }


    /**
     * @param MiddlewareInterface $middleware
     * @param string|null         $prefix     Path prefix the middleware will work
     *                                        Example: 1. In this cases all
     *                                        request with paths that begins with
     *                                        "/top-secret" will be handled with
     *                                        AuthenticationMiddleware
     *                                        $micro->use(new
     *                                        AuthenticationMiddleware(),
     *                                        '/top-secret'); 2. Middleware will
     *                                        work with each request:
     *                                        $micro->use(new LoggerMiddleware(),
     *                                        null); $micro->use(new
     *                                        LoggerMiddleware(), '/');
     */
    public function use(MiddlewareInterface $middleware, ?string $prefix = null): void
    {
        if ($prefix !== '/' && $prefix !== null) {
            /**
             * There is a spl_object_hash instead because its mandatory to match condition with single middleware.
             * Passing FQCN will override other instances of given FQCN
             */
            $this->middlewarePrefixes[spl_object_hash($middleware)] = $prefix;
        }

        $this->middlewares[] = $middleware;
    }

    public function run(?ServerRequestInterface $request = null): void
    {

        if ($request === null) {
            $psr17Factory = new Psr17Factory();
            $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
            $request = $psrHttpFactory->createRequest(Request::createFromGlobals());
        }

        if ($this->container === null) {
            $this->container = $this->containerBuilder->build($this->config);
        }

        $middlewares[] = new ErrorHandlerMiddleware(); //error handler
        $middlewares = array_merge($middlewares, $this->middlewares); //merge user defined with default ones
        $middlewares[] = new DispatcherMiddleware($this->router, $this->container); //this one executes the request

        $handler = new RequestHandler($middlewares); //this will iterate through all middlewares
        $response = $handler->handle($request);

        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyResponse = $httpFoundationFactory->createResponse($response);

        $symfonyResponse->send();

    }


    /**
     * Return RFC7807 Compliant Error response
     *
     * @param  Throwable $e
     * @return JsonResponse
     */
    protected function handleErrorResponse(Throwable $e)
    {

        $content['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        $content['title'] = get_class($e);
        $content['detail'] = $e->getMessage();
        $content['trace'] = $e->getTrace();

        $response = new JsonResponse($content, Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->headers->set('Content-Type', 'application/problem+json');
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT/**
            * | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE 
            **/
        );

        return $response;
    }

    /**
     * @param  Request $request
     * @return JsonResponse|Response
     */
    public function handleRequest(Request $request)
    {
        //execute before events
        try {
            $route = $this->router->matchRequest($request);
        } catch (MethodNotAllowedException $e) {
            return $this->handleErrorResponse($e);
        } catch (RouteNotFoundException $e) {
            return $this->handleErrorResponse($e);
        }

        /**
 * @var Closure $callback 
*/
        $callback = $route->getController();

        $response = $callback();

        if (is_array($response)) {
            $response = new JsonResponse($response);
        }

        if (is_string($response) || $response === null) {
            $response = new Response($response);
        }

        //execute after events

        return $response;

    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}