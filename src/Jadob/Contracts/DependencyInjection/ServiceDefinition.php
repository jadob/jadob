<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Closure;

class ServiceDefinition
{
    private ?Closure $factory = null;

    private array $tags = [];
    public function __construct(
        private string $id,
        private string $className,
    )
    {
    }

    /** @var array<non-empty-string, Reference> */
    private array $args = [];

    public function withArg(
        string $name,
        Reference|string|int|array|null|bool $argument,
    ): self
    {
        if(!($argument instanceof Reference)) {
            $argument = Reference::literal($argument);
        }

        $this->args[$name] = $argument;

    public function factory(
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
}
