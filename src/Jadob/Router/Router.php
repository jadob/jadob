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
     * @var Route[]
     */
    private $routes;

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
    private $request;

    /**
     * @param array $config
     * @throws \RuntimeException
     */
    public function __construct(array $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;

        $this->registerRoutes();
    }

    /**
     * @throws \RuntimeException
     */
    public function registerRoutes()
    {
        foreach ($this->config['routes'] as $key => $data) {

            if (!isset($data['controller'])) {
                throw new \RuntimeException('Path "' . $key . '" has no controller class defined.');
            }

            if (!isset($data['path'])) {
                throw new \RuntimeException('Path "' . $key . '" has no path defined.');
            }

            $route = new Route($key);
            $route
                ->setController($data['controller'])
                ->setPath($data['path'])
                ->setAction($data['action'] ?? null);

            if (isset($data['ignore_locale_prefix'])) {
                $route->setIgnoreLocalePrefix($data['ignore_locale_prefix']);
            }

            $this->routes[$key] = $route;
        }

        return $this;
    }

    /**
     *
     * @param Request $request
     * @return Route
     * @throws RouteNotFoundException
     */
    public function matchRoute(Request $request): Route
    {
        $uri = $request->getPathInfo();


        $explodedURI = explode('?', $uri);

        $uri = $explodedURI[0];

        foreach ($this->routes as $route) {
            /** @var Route $route * */
            if (isset($this->config['locale_prefix']) && !$route->isIgnoreLocalePrefix()) {
                $path = $this->getRegex($this->config['locale_prefix'] . $route->getPath());
            } else {
                $path = $this->getRegex($route->getPath());
            }

            $matches = [];

            if ($path !== false && preg_match($path, $uri, $matches)) {
                $params = array_intersect_key(
                    $matches, array_flip(array_filter(array_keys($matches), 'is_string'))
                );

                if (isset($this->config['locale_prefix']) && !$route->isIgnoreLocalePrefix()) {
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


    protected function findUriAlias()
    {

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

        if (!isset($this->routes[$name])) {
            throw new RouteNotFoundException('Route "' . $name . '" is not defined');
        }

        $route = $this->routes[$name];

        if (isset($this->config['locale_prefix']) && !$route->isIgnoreLocalePrefix()) {
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
            return $this->request->getSchemeAndHttpHost() . $convertedPath;
        }
        return $convertedPath;

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

    /**
     * @return Route[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param Route[] $routes
     * @return Router
     */
    public function setRoutes(array $routes): Router
    {
        $this->routes = $routes;

        return $this;
    }
}
