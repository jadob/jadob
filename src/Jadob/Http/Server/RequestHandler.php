<?php

declare(strict_types=1);

namespace Jadob\Http\Server;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function spl_object_hash;
use function strpos;

class RequestHandler implements RequestHandlerInterface
{

    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares = [];

    /**
     * @var array<string, string>
     */
    protected $prefixConditions = [];

    /**
     * @var int
     */
    protected $currentMiddleware = -1;

    /**
     * RequestHandler constructor.
     *
     * @param array $middlewares
     * @param array $prefixConditions
     */
    public function __construct(array $middlewares = [], array $prefixConditions = [])
    {
        $this->middlewares = $middlewares;
        $this->prefixConditions = $prefixConditions;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     *
     * @param  ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $skipCurrent = false;
        $this->currentMiddleware++;
        $middlewareToHandle = $this->middlewares[$this->currentMiddleware];

        /**
         * Path prefix verification
         */
        $middlewareHash = spl_object_hash($middlewareToHandle);
        if (isset($this->prefixConditions[$middlewareHash])) {
            $prefix = $this->prefixConditions[$middlewareHash];
            $skipCurrent = strpos($request->getUri()->getPath(), $prefix) === 0;
        }

        if ($skipCurrent) {
            $this->currentMiddleware++;
            $middlewareToHandle = $this->middlewares[$this->currentMiddleware];
        }

        $response = $middlewareToHandle->process($request, $this);

        if ($skipCurrent) {
            $this->currentMiddleware--;
        }

        $this->currentMiddleware--;
        return $response;
    }
}