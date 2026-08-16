<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Closure;
use function in_array;

final class ServiceDefinition
{
    private(set) ?Closure $factory = null;

    private(set) array $tags = [];

    private(set) array $methodCalls = [];

    private(set) bool $autowired = false;

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
        if(array_key_exists($name, $this->arguments) === true) {
            throw new \LogicException(
                sprintf('Argument "%s" is already defined, use replaceArgument() to override it.', $name)
            );
        }

        if(!($argument instanceof Reference)) {
            $argument = Reference::literal($argument);
        }

        $this->arguments[$name] = $argument;

        return $this;
    }

    public function replaceArgument(
        string $name,
        Reference|string|int|array|null|bool $argument,
    ): self
    {
        if(array_key_exists($name, $this->arguments) === false) {
            throw new \LogicException(
                sprintf('Argument "%s" does not exists, use withArgument() to define it.', $name)
            );
        }

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

    public function autowire(): self
    {
        $this->autowired = true;

        return $this;
    }

    public function hasArgument(
        string $name,
    ): bool
    {
        return array_key_exists($name, $this->arguments);
    }
}
