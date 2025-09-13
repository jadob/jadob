<?php

declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\RouterException;
use LogicException;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
readonly class Route
{
    public function __construct(
        protected(set) string $name,
        protected(set) string $path,
        protected(set) string|array|object $handler,
        protected(set) ?string $host = null,
        protected(set) array $methods = [],
        protected(set) array $parameters = [],
        protected(set) array $pathParameters = [],
        protected(set) ?RouteCollection $parentCollection = null
    )
    {

    }

    public function getPath(): string
    {
        if ($this->parentCollection !== null) {
            return $this->parentCollection->getPrefix() . $this->path;
        }

        return $this->path;
    }

    /**
     * @param array $data
     * @return Route
     * @throws RouterException
     */
    public static function fromArray(array $data): Route
    {
        if (isset($data['method'])) {
            throw new LogicException('Invalid key "method". Did you mean "methods"?');
        }

        if (!isset($data['name'])) {
            throw new RouterException('Missing "name" key in $data.');
        }

        if (!isset($data['path'])) {
            throw new RouterException('Missing "path" key in $data.');
        }

        return new self(
            $data['name'],
            $data['path'],
            $data['handler'],
            $data['host'] ?? null,
            $data['methods'] ?? [],
            $data['parameters'] ?? [],
            $data['path_parameters'] ?? []
        );
    }
}
