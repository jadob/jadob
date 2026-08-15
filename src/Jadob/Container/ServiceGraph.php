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

        foreach ($def->tags as $tag) {
            $this->tag($def->id, $tag);
        }
    }

    public function get(string $id): ServiceDefinition
    {
        if(isset($this->aliases[$id])) {
            return $this->get($this->aliases[$id]);
        }

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
        $this->tags[$tag][] = $id;
    }

    public function findTagged(string $tag): array
    {
        return $this->tags[$tag] ?? [];
    }

    /**
     * @return ServiceDefinition[]
     */
    public function all(): array
    {
        return $this->definitions;
    }
}