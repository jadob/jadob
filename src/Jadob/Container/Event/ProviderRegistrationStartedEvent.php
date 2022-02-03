<?php

declare(strict_types=1);

namespace Jadob\Container\Event;

class ProviderRegistrationStartedEvent implements BuilderRelatedEventInterface
{
    public $providerClass;
    public function __construct(string $providerClass)
    {
        $this->providerClass = $providerClass;
    }

    public function getPayload(): string
    {
        return $this->providerClass;
    }
}