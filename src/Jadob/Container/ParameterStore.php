<?php

namespace Jadob\Container;

class ParameterStore
{

    public function __construct(
        /**
         * @var array<string, int|string|bool|array>
         */
        private array $parameters,
    )
    {
    }

    public function set(string $key, $value): void
    {
        $this->parameters[$key] = $value;
    }

    public function get(string $key) {
        return $this->parameters[$key];
    }
}