<?php

namespace Jadob\Micro;

use Jadob\Container\Container;
use Jadob\EventListener\EventListener;
use Jadob\Router\Route;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher;
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
     * @var Route[]
     */
    protected $routes;

    /**
     * @var EventListener
     */
    protected $eventListener;

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->enviroment = $config['environment'] ?? 'prod';
        $this->services = $config['services'] ?? [];
    }

    public function get($path, $callback)
    {
        $route = new Route($path);
        $route->setPath($path);
        $route->setController($callback);
        $route->setMethods(Route::METHOD_GET);

        $this->routes[] = $route;
        return $this;
    }


    public function run()
    {
        $request = Request::createFromGlobals();
        $response = null;

        //execute before events

        foreach ($this->routes as $route) {
            $matcher = new RequestMatcher(
                $route->getPath()
            );

            if ($matcher->matches($request)) {
                /** @var \Closure $callback */
                $callback = $route->getController();

                if (!($callback instanceof \Closure)) {
                    $response = new JsonResponse([
                        'error' => 'Controller should be Closure, ' . gettype($callback) . ' passed'
                    ]);
                }

                $callbackResponse = $callback();

                if(\is_array($callbackResponse)) {
                    $response = new JsonResponse($callbackResponse);
                }

                if(\is_string($callbackResponse) || $callbackResponse === null) {
                    $response = new Response($callbackResponse);
                }

            }
        }

        //execute after events

        $response->send();
    }

    /**
     * @param int $bitmask
     */
    public function decodeMethodsBitmask($bitmask)
    {

    }

    /**
     * @param array $services
     */
    protected function buildContainer(array $services) {

    }
}