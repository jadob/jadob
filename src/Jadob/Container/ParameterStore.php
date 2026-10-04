<?php
declare(strict_types=1);

namespace Jadob\Container;

/**
 * @phpstan-type ParameterType int|string|bool|array<array-key,mixed>
 */
final class ParameterStore
{
    /**
     * @param array<string, ParameterType> $parameters
     */
    public function __construct(
        private array $parameters,
    ) {
    }

    /**
     * @param string $key
     * @param ParameterType $value
     * @return void
     */
    public function set(string $key, int|string|bool|array $value): void
    {
        $this->parameters[$key] = $value;
    }


    /**
     * @param string $key
     * @return ParameterType
     */
    public function get(string $key): int|string|bool|array
    {
        return $this->parameters[$key];
    }
}