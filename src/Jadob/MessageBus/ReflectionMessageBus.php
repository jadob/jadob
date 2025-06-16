<?php

namespace Jadob\MessageBus;

/**
 * @internal
 */
class ReflectionMessageBus
{
    public function __construct(
        private array $handlers
    )
    {
    }


    public function handle(object $message): mixed
    {
        foreach ($this->handlers as $handler) {
            $reflection = new \ReflectionClass($handler);

            foreach ($reflection->getMethods() as $method) {
                $methodName = $method->getName();
                $params = $method->getParameters();

                if (count($params) !== 1) {
                    continue;
                }
                if (array_any($params, fn($param) => $param->getType()->getName() === get_class($message))) {
                    return $handler->$methodName($message);
                }
            }
        }

        throw new \LogicException(
            sprintf(
                'No handler for message "%s"',
                get_class($message)
            )
        );
    }

}