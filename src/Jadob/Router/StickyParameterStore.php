<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Core\RequestContextStore;

class StickyParameterStore implements ParameterStoreInterface
{
    protected RequestContextStore $contextStore;

    public function __construct(RequestContextStore $contextStore)
    {
        $this->contextStore = $contextStore;
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