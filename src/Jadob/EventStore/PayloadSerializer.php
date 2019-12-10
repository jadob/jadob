<?php


namespace Jadob\EventStore;

use function json_encode;

class PayloadSerializer
{

    public function serialize(array $payload): string
    {
        return json_encode($payload, JSON_THROW_ON_ERROR);
    }
}