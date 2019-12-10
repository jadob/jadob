<?php

declare(strict_types=1);

namespace Jadob\Http\Middleware;

use Jadob\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Container\ContainerInterface;

class DispatcherMiddleware implements MiddlewareInterface
{

    /**
     * @var Router
     */
    protected Router $router;

    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * DispatcherMiddleware constructor.
     * @param Router $router
     * @param ContainerInterface $container
     */
    public function __construct(Router $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $this->router->matchRoute(
            $request->getUri()->getPath(),
            $request->getMethod()
        );

        $controller = $route->getController();
        /** @var ResponseInterface $response */
        $response = $controller($request);

        return $response;
    }
}