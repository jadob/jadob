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
     */
    public function __construct(array $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;
        $this->routes = $this->registerRoutes();

    }

    /**
     * @return array
     */
    private function registerRoutes()
    {
        $output = [];

        foreach ($this->config['routes'] as $key => $data) {
            $route = new Route($key);
            $route
                ->setController($data['controller'])
                ->setPath($data['path'])
                ->setAction(isset($data['action'])? $data['action'] : '__invoke');

            if (isset($data['ignore_locale_prefix'])) {
                $route->setIgnoreLocalePrefix($data['ignore_locale_prefix']);
            }

            $output[$key] = $route;
        }

        return $output;
    }

    /**
     *
     * @param Request $request
     * @return Route
     * @throws RouteNotFoundException
     */
    public function matchRoute(Request $request)
    {
        $uri = $request->server->get('REQUEST_URI');
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
        throw new RouteNotFoundException('No route matched for URI '.$uri);
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
    public function generateRoute($name, $params = [], $full = false)
    {

        if(!isset($this->routes[$name])) {
            throw new RouteNotFoundException('Route "'.$name.'" is not defined');
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
            $convertedPath = str_replace('{' . $key . '}', $param, $convertedPath, $isFound);

            if ($isFound === 0) {
                $paramsToGET[$key] = $param;
            }
        }

        if(count($paramsToGET) !== 0) {
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
    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }

    /**
     * @param Route $currentRoute
     * @return Router
     */
    public function setCurrentRoute(Route $currentRoute)
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
