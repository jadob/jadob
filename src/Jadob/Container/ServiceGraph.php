<?php

namespace Jadob\Container;

use Jadob\Contracts\DependencyInjection\ServiceDefinition;

class ServiceGraph
{
    /**
     * @var array<string, ServiceDefinition>
     */
    private array $definitions = [];

    /**
     * @var array<string, string> alias → target
     */
    private array $aliases = [];

    /**
     * @var array<string, list<string>> tag → service IDs
     */
    private array $tags = [];

    public function add(ServiceDefinition $def): void
    {
        $this->definitions[$def->id] = $def;
    }

    public function get(string $id): ServiceDefinition
    {
        return $this->definitions[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id])
            || isset($this->aliases[$id]);
    }

    public function remove(string $id): void
    {
        unset($this->definitions[$id]);
    }

    public function alias(string $alias, string $target): void
    {
        $this->aliases[$alias] = $target;
    }

    public function tag(string $id, string $tag): void
    {
        $this->tags[$tag][] = $tag;
    }

    public function findTagged(string $tag): array
    {
        return $this->tags[$tag] ?? [];
    }

    public function all(): array
    {
        return $this->definitions;
    }
}