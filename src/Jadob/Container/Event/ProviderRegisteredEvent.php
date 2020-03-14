<?php

declare(strict_types=1);

namespace Jadob\Container\Event;

class ProviderRegisteredEvent implements BuilderRelatedEventInterface
{
    protected $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }


    public function getPayload(): string
    {
        return $this->className;
    }
}