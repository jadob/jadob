<?php

declare(strict_types=1);

namespace Jadob\Container\Event;

/**
 * @deprecated
 */
class ServiceAddedEvent implements BuilderRelatedEventInterface
{
    protected $serviceName;

    public function __construct(string $serviceName)
    {
        $this->serviceName = $serviceName;
    }

    public function getPayload(): string
    {
        return $this->serviceName;
    }
}