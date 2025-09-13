<?php

declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Exception\RouterException;
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
    public function __construct(
        private RouteCollection $routeCollection,
        private RouterContext   $context,
        private bool            $caseSensitive = false
    )
    {
    }

    /**
     * @param string $uri
     * @param string $method
     * @return MatchedRoute
     * @throws RouteNotFoundException|MethodNotAllowedException
     */
    public function match(
        string $uri,
        string $method,
    ): MatchedRoute
    {
        $matchedRoutes = [];
        foreach ($this->routeCollection as $route) {
            $path = $route->path;
            $regex = $this->pathToExpression(
                $path,
                $route->pathParameters ?? []
            );

            $result = (bool)preg_match(
                $regex,
                $uri,
                $matches,
            );

            if ($result) {
                $matchedRoute = new MatchedRoute(
                    route: $route,
                    pathParameters: $this->transformMatchesToParameters($matches)
                );

                $matchedRoutes[] = $matchedRoute;

                if (in_array($method, $route->methods)) {
                    return $matchedRoute;
                }
            }
        }

        if (count($matchedRoutes) > 0) {
            throw new MethodNotAllowedException();
        }

        throw new RouteNotFoundException();
    }


    private function pathToExpression(string $path, array $params): string
    {
        //TODO: caching!
        if (\preg_match('/[^-:.,\/_{}()a-zA-Z*\d]/', $path)) {
            throw new \LogicException(
                sprintf('Unable to match route as phrase "%s" contains illegal characters.', $path)
            );
        }

        \preg_match_all(
            '/{([a-zA-Z0-9\.\_\-]+)}/',
            $path,
            $pathParams,
            PREG_SET_ORDER
        );

        foreach ($pathParams as $pathParam) {
            $pathParamMatch = PathParamMatchType::DEFAULT;
            if (\array_key_exists($pathParam[1], $params)) {
                $pathParamMatch = $params[$pathParam[1]];
            }

            $path = \preg_replace(
                \sprintf('/{(%s)}/', $pathParam[1]),
                \sprintf('(?<$1>%s)', $pathParamMatch),
                $path
            );

        }

        // Add start and end matching
        $patternAsRegex = '%^' . $path . '$%D';
        if (!$this->caseSensitive) {
            $patternAsRegex .= 'i';
        }

        return $patternAsRegex;
    }


    /**
     * @param null|string $pattern
     * @throws RouterException
     * @deprecated
     */
    protected function getRegex(?string $pattern): string
    {
        if (preg_match('/[^-:.,\/_{}()a-zA-Z\d]/', (string)$pattern)) {
            throw new RouterException(
                sprintf('Unable to match route as phrase "%s" contains illegal characters.', $pattern)
            );
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
     * @throws RouteNotFoundException|RouterException
     * @deprecated
     */
    public function generateRoute(string $name, array $params = [], $full = false): string
    {
        foreach ($this->routeCollection as $routeName => $route) {
            if ($routeName === $name) {
                $path = $this->context->getAlias() . $route->getPath();
                $paramsToGET = [];
                $convertedPath = $path;
                $convertedPathParams = $this->extractPathParams($convertedPath);

                foreach ($convertedPathParams as $convertedPathParam) {
                    if (isset($params[$convertedPathParam])) {
                        continue;
                    }

                    if ($this->paramStore instanceof ParameterStoreInterface && $this->paramStore->has($convertedPathParam)) {
                        $params[$convertedPathParam] = $this->paramStore->get($convertedPathParam);
                        continue;
                    }

                    throw new RouterException(
                        sprintf('Unable to generate path "%s": missing "%s" param', $name, $convertedPathParam)
                    );
                }

                foreach ($params as $key => $param) {
                    $isFound = 0;
                    if (!is_array($param)) {
                        $convertedPath = str_replace('{' . $key . '}', (string)$param, $convertedPath, $isFound);
                    }

                    if ($isFound !== 0 && is_array($param)) {
                        throw new RouterException(
                            sprintf('Param "%s" cannot be injected into route "%s" as it is an array.', $param, $name)
                        );
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
     * @param string $path
     * @return array
     * @deprecated
     */
    protected function extractPathParams(string $path): array
    {
        $regexp = '@\{(.+?)\}@i';
        $matches = [];
        preg_match_all($regexp, $path, $matches);

        return end($matches);
    }

    /**
     * @return RouterContext
     * @deprecated
     */
    public function getContext(): RouterContext
    {
        return $this->context;
    }

    /**
     * @param RouterContext $context
     * @return Router
     * @deprecated
     */
    public function setContext(RouterContext $context): Router
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @return RouteCollection
     * @deprecated
     */
    public function getRouteCollection(): RouteCollection
    {
        return $this->routeCollection;
    }

    /**
     * @param array $matches
     * @return array
     */
    private function transformMatchesToParameters(array $matches): array
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
     * @deprecated
     */
    public function addRoute(Route $route): Router
    {
        $this->routeCollection->addRoute($route);
        return $this;
    }

    /**
     * @param RouteMatcherInterface $matcher
     * @return void
     * @deprecated
     */
    public function addRouteMatcher(RouteMatcherInterface $matcher)
    {
        $this->matchers[] = $matcher;
    }
}

