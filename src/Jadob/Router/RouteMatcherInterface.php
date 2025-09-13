<?php

declare(strict_types=1);

namespace Jadob\Router;

use Symfony\Component\HttpFoundation\Request;

/**
 * Allows to perform additional checks while matching a route.
 * @deprecated
 * @license MIT
 */
interface RouteMatcherInterface
{
    public function matches(Route $route, Request $request): bool;
}