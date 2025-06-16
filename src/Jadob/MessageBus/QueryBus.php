<?php

namespace Jadob\MessageBus;

/**
 * @see https://dev.to/rubenrubiob/type-hint-a-query-bus-in-php-3aik
 */
class QueryBus
{

    private ReflectionMessageBus $messageBus;

    /**
     * @param list<object> $handlers
     */
    public function __construct(
        array $handlers
    )
    {
        $this->messageBus = new ReflectionMessageBus($handlers);
    }


    public function query(object $command): mixed
    {
        return $this->messageBus->handle($command);
    }
}