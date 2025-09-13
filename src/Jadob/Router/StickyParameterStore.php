<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Core\RequestContextStore;

/**
 * @deprecated
 */
class StickyParameterStore implements ParameterStoreInterface
{
    public function __construct(protected RequestContextStore $contextStore)
    {
    }

    public function has(string $paramName): bool
    {
        $matchedRoute = $this->contextStore->latest()->getRoute();
        $matchedRouteParams = $matchedRoute->getParams();

        return isset($matchedRouteParams[$paramName]);
    }

    public function get(string $paramName): string
    {
        return $this->contextStore->latest()->getRoute()->getParams()[$paramName];
    }
}