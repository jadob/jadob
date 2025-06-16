<?php

namespace Jadob\MessageBus;

class CommandBus
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


    public function handle(object $command): mixed
    {
        return $this->messageBus->handle($command);
    }
}