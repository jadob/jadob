<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Closure;
use function in_array;

class ServiceDefinition
{
    private ?Closure $factory = null;

    private array $tags = [];

    private array $methodCalls = [];

    public function __construct(
        private(set) readonly string $id,
        private(set) readonly string $className,
    )
    {
    }

    /**
     * @var array<non-empty-string, Reference>
     */
    private(set) array $arguments = [];

    public function withArgument(
        string $name,
        Reference|string|int|array|null|bool $argument,
    ): self
    {
        if(!($argument instanceof Reference)) {
            $argument = Reference::literal($argument);
        }

        $this->arguments[$name] = $argument;

        return $this;
    }

    public function withFactory(
        Closure $factory,
    ): self
    {
        $this->factory = $factory;
        return $this;
    }

    public function withTag(
        string $tag,
    ): self
    {
        $this->tags[] = $tag;
        return $this;
    }

    public function hasTag(string $tag): bool
    {
        return in_array($tag, $this->tags);
    }

    public function addMethodCall(
        string $methodName,
        array $arguments = [],
    ): void
    {
        $this->methodCalls[$methodName][] = $arguments;
    }
}
