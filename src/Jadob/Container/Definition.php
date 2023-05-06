<?php
declare(strict_types=1);

namespace Jadob\Container;

use Closure;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Definition
{

    /**
     * @psalm-var class-string|object|Closure
     */
    protected string|object $service;

    /**
     * @var DefinitionMethodCall[]
     */
    protected array $methodCalls = [];

    /**
     * @var string[]
     */
    protected array $tags = [];

    public function __construct(string|object $service)
    {
        $this->service = $service;
    }

    public function addMethodCall(string $methodName, array $arguments = []): self
    {
        $this->methodCalls[] = new DefinitionMethodCall($methodName, $arguments);

        return $this;
    }

    public function addTag(string $tag): void
    {
        $this->tags[] = $tag;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return array[]
     */
    public function getMethodCalls(): array
    {
        return $this->methodCalls;
    }

    /**
     * @return object
     */
    public function getService(): object
    {
        return $this->service;
    }
}