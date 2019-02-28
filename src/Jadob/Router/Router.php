<?php

namespace Jadob\Router;

use Jadob\Router\Exception\RouteNotFoundException;
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
    private $config;

    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @var Route
     */
    private $currentRoute;

    /**
     * @var array
     */
    private $globalParams = [];

    /**
     * @var Request
     */
    private $context;

    /**
     * @param RouteCollection $routeCollection
     * @param Request|null $context
     */
    public function __construct(RouteCollection $routeCollection, Request $context = null)
    {
        $this->routeCollection = $routeCollection;

        if ($context !== null) {
            $this->context = $context;
        } else {
            $this->context = Request::createFromGlobals();
        }
    }


    protected function hostMatches(Route $route, $host)
    {
        if ($route->getHost() === null) {
            return true;
        }

        return $route->getHost() === $host;
    }

    /**
     *
     * @param Request $request
     * @return Route
     * @throws RouteNotFoundException
     */
    public function matchRequest(Request $request): Route
    {
        $uri = $request->getPathInfo();

        foreach ($this->routeCollection as $routeKey => $route) {

            $path = $route->getPath();
            /** @var Route $route * */
            if (isset($this->config['global_prefix']) && !$route->isIgnoreGlobalPrefix()) {
                $path = $this->getRegex($this->config['global_prefix'] . $path);
            } else {
                $path = $this->getRegex($path);
            }

            $matches = [];

            if ($path !== false && preg_match($path, $uri, $matches)
                && $this->hostMatches($route, $request->getHost())

            ) {
                $params = array_intersect_key(
                    $matches, array_flip(array_filter(array_keys($matches), 'is_string'))
                );

                if (isset($this->config['locale_prefix']) && !$route->isIgnoreGlobalPrefix()) {
                    $this->globalParams['_locale'] = $params['_locale'];
                }

                $route->setParams($params);
                $this->currentRoute = $route;

                return $route;
            }
        }

        throw new RouteNotFoundException('No route matched for URI ' . $uri);
    }

    /**
     * @param $pattern
     * @return bool|string
     */
    public function getRegex($pattern)
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
                if (isset($this->config['locale_prefix']) && !$route->isIgnoreGlobalPrefix()) {
                    $path = $this->config['locale_prefix'] . $route->getPath();
                    $params = array_merge($params, $this->globalParams);

                } else {
                    $path = $route->getPath();
                }

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
                    return $this->context->getSchemeAndHttpHost() . $convertedPath;
                }
                return $convertedPath;
            }
        }

        throw new RouteNotFoundException('Route "' . $name . '" is not defined');

    }

    /**
     * @return Route
     */
    public function getCurrentRoute(): Route
    {
        return $this->currentRoute;
    }

    /**
     * @param Route $currentRoute
     * @return Router
     */
    public function setCurrentRoute(Route $currentRoute): Router
    {
        $this->currentRoute = $currentRoute;

        return $this;
    }

    /**
     * @return array
     */
    public function getGlobalParams()
    {
        return $this->globalParams;
    }

    /**
     * @return string
     */
    public function getGlobalParam($key)
    {
        return $this->globalParams[$key];
    }

    /**
     * @param array $globalParams
     * @return Router
     */
    public function setGlobalParams(array $globalParams)
    {
        $this->globalParams = $globalParams;

        return $this;
    }

}
