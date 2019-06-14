<?php

namespace Jadob\Router;

use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Exception\RouterException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Router
 * Service name: router
 * @package Jadob\Router
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Router
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @var string
     */
    protected $leftDelimiter = '{';

    /**
     * @var string
     */
    protected $rightDelimiter = '}';

    /**
     * @var Context
     */
    protected $context;

    /**
     * @param RouteCollection $routeCollection
     * @param Context|null $context
     */
    public function __construct(RouteCollection $routeCollection, ?Context $context = null)
    {
        $this->routeCollection = $routeCollection;

        $this->config = [
            'case_sensitive' => false
        ];

        if ($context !== null) {
            $this->context = $context;
        } else {
            $this->context = Context::fromGlobals();
        }
    }

    /**
     * @param Route $route
     * @param $host
     * @param array $matchedAttributes
     * @return bool
     */
    protected function hostMatches(Route $route, $host, array &$matchedAttributes): bool
    {

        if ($route->getHost() === null) {
            return true;
        }

        $hostRegex = $this->getRegex($route->getHost());

        if (
            $hostRegex !== false
            && preg_match($hostRegex, $host, $matches) > 0
        ) {
            $matchedAttributes = $this->transformMatchesToParameters($matches);
            return true;
        }

        return $route->getHost() === $host;
    }


    /**
     * @param string $path
     * @param string $method
     * @return Route
     * @throws MethodNotAllowedException
     * @throws RouteNotFoundException
     */
    public function matchRoute(string $path, string $method): Route
    {
        $method = \strtoupper($method);

        foreach ($this->routeCollection as $routeKey => $route) {
            /** @var Route $route */
            $pathRegex = $this->getRegex($route->getPath());
            //@TODO: maybe we should break here if $pathRegex === false?
            $parameters = [];

            if ($pathRegex !== false
                && preg_match($pathRegex, $path, $matches) > 0
                && $this->hostMatches($route, $this->context->getHost(), $parameters)
            ) {

                if (
                    count(($routeMethods = $route->getMethods())) > 0
                    && !\in_array($method, $routeMethods)
                ) {
                    throw new MethodNotAllowedException();
                }

                $parameters = \array_merge($parameters, $this->transformMatchesToParameters($matches));

                $route->setParams($parameters);

                return $route;
            }

        }

        throw new RouteNotFoundException('No route matched for URI ' . $path);
    }

    /**
     * @param Request $request
     * @return Route
     * @throws RouteNotFoundException
     * @throws MethodNotAllowedException
     */
    public function matchRequest(Request $request): Route
    {
        return $this->matchRoute(
            $request->getPathInfo(),
            $request->getMethod()
        );
    }

    /**
     * @param $pattern
     * @return bool|string
     */
    protected function getRegex($pattern)
    {
        if (preg_match('/[^-:.\/_{}()a-zA-Z\d]/', $pattern)) {
            return false; // Invalid pattern
        }

        $allowedParamChars = '[a-zA-Z0-9\.\_\-]+';
        // Create capture group for '{parameter}'
        $parsedPattern = preg_replace(
            '/{(' . $allowedParamChars . ')}/', # Replace "{parameter}"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Add start and end matching
        $patternAsRegex = '%^' . $parsedPattern . '$%D';

        if (!$this->config['case_sensitive']) {
            $patternAsRegex .= 'i';
        }

        return $patternAsRegex;
    }

    /**
     * @param $name
     * @param $params
     * @param bool $full
     * @return mixed|string
     * @throws RouteNotFoundException
     */
    public function generateRoute($name, array $params = [], $full = false)
    {
        foreach ($this->routeCollection as $routeName => $route) {
            if ($routeName === $name) {
                $path = $route->getPath();
                $paramsToGET = [];
                $convertedPath = $path;
                foreach ($params as $key => $param) {

                    $isFound = 0;
                    if (!\is_array($param)) {
                        $convertedPath = str_replace('{' . $key . '}', $param, $convertedPath, $isFound);
                    };

                    if ($isFound === 0) {
                        $paramsToGET[$key] = $param;
                    }
                }

                if (\count($paramsToGET) !== 0) {
                    $convertedPath .= '?';
                    $convertedPath .= http_build_query($paramsToGET);
                }

                if ($full) {
                    $scheme = 'http';

                    if ($this->context->isSecure()) {
                        $scheme = 'https';
                    }

                    $port = $this->context->getPort();

                    if (
                        !\in_array($port, [80, 443], true)
                        || (!$this->context->isSecure() && $port === 443)
                    ) {
                        $port = ':' . $port;
                    } else {
                        $port = null;
                    }

                    return $scheme
                        . '://'
                        . $this->context->getHost()
                        . $port
                        . $convertedPath;

                }
                return $convertedPath;
            }
        }

        throw new RouteNotFoundException('Route "' . $name . '" is not defined');

    }

    /**
     * @return Context
     */
    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * @param Context $context
     * @return Router
     */
    public function setContext(Context $context): Router
    {
        $this->context = $context;
        return $this;
    }

    /**
     * Allows to set custom route argument delimiters
     * @param string $left
     * @param string $right
     * @return $this
     * @throws RouterException
     */
    public function setParameterDelimiters(string $left, string $right)
    {
        if ($left === '' || $right === '') {
            throw new RouterException('Parameter delimiters cannot be blank');
        }

        $this->leftDelimiter = $left;
        $this->rightDelimiter = $right;

        return $this;
    }

    /**
     * @return RouteCollection
     */
    public function getRouteCollection(): RouteCollection
    {
        return $this->routeCollection;
    }

    /**
     * @param array $matches
     * @return array
     */
    protected function transformMatchesToParameters(array $matches): array
    {
        return array_intersect_key(
            $matches,
            array_flip(
                array_filter(
                    array_keys($matches),
                    'is_string'
                )
            )
        );
    }
}

