<?php

namespace Jadob\Micro;

use Jadob\EventListener\EventListener;
use Jadob\Router\Context;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Route;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Silex/Lumen style microframework kernel.
 * If you want to quickly create APIs or microservices, this one will be better than creating app using Jadob\Core\Kernel.
 *
 * Jadob\Micro is an boilerplate which allows you to create things without being worried about configuration, defining
 * service providers. Everything is pre-composed.
 *
 * Which features arent included in Micro?
 * - Path generator - you pass only path, methods, and callback. you have to generate routes by yourself.
 * - Bootstrap class it is not needed here.
 * - Console (so far)
 *
 *
 * @package Jadob\Micro
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Application /**implements \ArrayAccess **/
{
    /**
     * Micro uses the same codebase as Jadob so both will have the same versions.
     * @var string;
     */
    const VERSION = '0.0.60';

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string (dev|prod)
     */
    protected $enviroment = 'prod';

    /**
     * @var EventListener
     */
    protected $eventListener;

    /**
     * @var array
     */
    protected $services;

    /**
     * @var Router
     */
    protected $router;

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->enviroment = $config['env'] ?? 'prod';
        $this->services = $config['services'] ?? [];
        $this->router = new Router(new RouteCollection(), Context::fromGlobals());
    }

    public function get($path, $callback)
    {
        $route = new Route($path);
        $route->setPath($path);
        $route->setController($callback);
        $route->setMethods(['GET']);

        $this->router->getRouteCollection()->addRoute($route);
        return $this;
    }

    public function run()
    {
        $request = Request::createFromGlobals();
        $response = null;

        $this->handleRequest($request)
            ->prepare($request)
            ->send();
    }


    protected function matchRequest() {}

    /**
     * Return RFC7807 Compliant Error response
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function handleErrorResponse(\Throwable $e) {

        $content['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        $content['title'] = \get_class($e);
        $content['detail'] = $e->getMessage();
        $content['trace'] = $e->getTrace();

        $response = new JsonResponse($content, Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->headers->set('Content-Type', 'application/problem+json');
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT /**| JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE **/
        );

        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function handleRequest(Request $request)
    {
        //execute before events
        try {
            $route = $this->router->matchRequest($request);
        } catch (MethodNotAllowedException $e) {
            return  $this->handleErrorResponse($e);
        } catch (RouteNotFoundException $e) {
            return $this->handleErrorResponse($e);
        }

        /** @var \Closure $callback */
        $callback = $route->getController();

        $response = $callback();

        if(\is_array($response)) {
            $response = new JsonResponse($response);
        }

        if(\is_string($response) || $response === null) {
            $response = new Response($response);
        }

        //execute after events

        return $response;

    }
}