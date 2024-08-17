<?php
declare(strict_types=1);

namespace Jadob\Container;

/**
 * @internal
 */
class DefinitionMethodCall
{
    public function __construct(
        protected string $methodName,
        protected array  $arguments
    ) {
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}