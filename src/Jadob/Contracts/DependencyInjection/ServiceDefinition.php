<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Closure;

class ServiceDefinition
{
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

        return $this;
    }
}
