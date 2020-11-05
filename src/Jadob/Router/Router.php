<?php

declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use function array_filter;
use function array_flip;
use function array_intersect_key;
use function array_keys;
use function array_merge;
use function count;
use function http_build_query;
use function in_array;
use function is_array;
use function preg_match;
use function str_replace;
use function strtoupper;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     * @var Context
     */
    protected $context;

    /**
     * @param RouteCollection $routeCollection
     * @param Context|null $context
     * @param array $config
     */
    public function __construct(RouteCollection $routeCollection, ?Context $context = null, array $config = [])
    {
        $this->routeCollection = $routeCollection;

        $defaultConfig = [
            'case_sensitive' => false
        ];

        $this->config = array_merge($defaultConfig, $config);

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
     *
     * @return bool
     */
    protected function hostMatches(Route $route, string $host, array &$matchedAttributes): bool
    {
        //route does not rely on hosts
        if ($route->getHost() === null) {
            return true;
        }

        $hostRegex = $this->getRegex($route->getHost());
        if ($hostRegex !== false
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
        $method = strtoupper($method);
        $availableMethodsFound = [];

        foreach ($this->routeCollection as $routeKey => $route) {
            /**
             * @var Route $route
             */
            $pathRegex = $this->getRegex($route->getPath());
            //@TODO: maybe we should break here if $pathRegex === false?
            $parameters = $route->getParams();

            if ($pathRegex !== false
                && preg_match($pathRegex, $path, $matches) > 0
                && $this->hostMatches($route, $this->context->getHost(), $parameters)
            ) {

                if (count(($routeMethods = $route->getMethods())) > 0
                    && !in_array($method, $routeMethods, true)
                ) {
                    $availableMethodsFound[] = $method;
                    //break later if no given method found
                    continue;
                }

                $parameters = array_merge($parameters, $this->transformMatchesToParameters($matches));
                $route->setParams($parameters);
                return $route;
            }
        }

        if (count($availableMethodsFound) > 0) {
            //TODO Pass methods here
            throw new MethodNotAllowedException();
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
        $matchedRoute = $this->matchRoute(
            $request->getPathInfo(),
            $request->getMethod()
        );

        $request->attributes->add($matchedRoute->getParams());
        return $matchedRoute;
    }

    /**
     * @param $pattern
     * @param null|string $pattern
     *
     * @return bool|string
     */
    protected function getRegex(?string $pattern)
    {
        if (preg_match('/[^-:.\/_{}()a-zA-Z\d]/', $pattern)) {
            return false; // Invalid pattern
        }

        $allowedParamChars = '[a-zA-Z0-9\.\_\-]+';
        // Create capture group for '{parameter}'
        $parsedPattern = preg_replace(
            '/{(' . $allowedParamChars . ')}/', // Replace "{parameter}"
            '(?<$1>' . $allowedParamChars . ')', // with "(?<parameter>[a-zA-Z0-9\_\-]+)"
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
     *
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public function generateRoute(string $name, array $params = [], $full = false): string
    {
        foreach ($this->routeCollection as $routeName => $route) {
            if ($routeName === $name) {
                $path = $this->context->getAlias().$route->getPath();
                $paramsToGET = [];
                $convertedPath = $path;
                foreach ($params as $key => $param) {

                    $isFound = 0;
                    if (!is_array($param)) {
                        $convertedPath = str_replace('{' . $key . '}', (string)$param, $convertedPath, $isFound);
                    }

                    if ($isFound === 0) {
                        $paramsToGET[$key] = $param;
                    }
                }

                if (count($paramsToGET) !== 0) {
                    $convertedPath .= '?';
                    $convertedPath .= http_build_query($paramsToGET);
                }

                if ($full) {
                    $scheme = 'http';

                    if ($this->context->isSecure()) {
                        $scheme = 'https';
                    }

                    $port = $this->context->getPort();

                    if (!in_array($port, [80, 443], true)
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

    /**
     * @param Route $route
     * @return $this
     */
    public function addRoute(Route $route): Router
    {
        $this->routeCollection->addRoute($route);
        return $this;
    }
}

