<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Closure;

class Definition
{
    private function __construct(
        /**
         * @var class-string
         */
        private ?string  $className = null,
        private array    $tags = [],
        private bool     $lazy = false,
        private bool     $autowired = false,
        private bool     $shared = true,
        private bool     $private = false,
        private ?Closure $factory = null,
    ) {
    }

    public static function create(): self
    {
        return new self();
    }

    /**
     * @phpstan-param class-string $name
     * @param string $name
     * @return $this
     */
    public function setClassName(string $name): self
    {
        $this->className = $name;
        return $this;
    }

    public function setFactory(Closure $factory): self
    {
        $this->factory = $factory;
        return $this;
    }

    public function isShared(): bool
    {
        return $this->shared;
    }

    public function setShared(bool $shared): self
    {
        $this->shared = $shared;
        return $this;
    }

    public function isPrivate(): bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): self
    {
        $this->private = $private;
        return $this;
    }

    public function getFactory(): ?Closure
    {
        return $this->factory;
    }

    public function setAutowired(bool $autowired): self
    {
        $this->autowired = $autowired;
        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }


    public static function fromArray(array $data): self
    {
        return new self(
            className: $data['class'] ?? null,
            tags: $data['tags'] ?? [],
            lazy: $data['lazy'] ?? false,
            autowired: $data['autowired'] ?? false,
            shared: $data['shared'] ?? false,
            private: $data['private'] ?? false,
            factory: $data['factory'] ?? null
        );
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function hasTag(string $tag): bool
    {
        return in_array($tag, $this->tags, true);
    }
}