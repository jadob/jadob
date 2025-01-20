<?php

namespace Jadob\Router;

use Symfony\Component\HttpFoundation\Request;

class RouterParamMatcher implements RouteMatcherInterface
{
    public function matches(Route $route, Request $request): bool
    {
        return in_array('yay', $route->getParams());
    }
}