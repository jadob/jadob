<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore;

use function json_encode;

class PayloadSerializer
{
    public function serialize(array $payload): string
    {
        return json_encode($payload, JSON_THROW_ON_ERROR);
    }
}