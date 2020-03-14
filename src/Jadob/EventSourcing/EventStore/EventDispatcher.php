<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use function get_class;


/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class EventDispatcher
{

    protected $listeners = [];

    /**
     * @param object $event
     *
     * @throws ReflectionException
     *
     * @return void
     */
    public function emit(object $event): void
    {
        $eventType = get_class($event);
        foreach ($this->listeners as $listener) {
            $listenerReflection = new ReflectionClass($listener);
            foreach ($listenerReflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                $paramsCount = $method->getNumberOfParameters();
                if ($paramsCount > 1) {
                    continue; //only one argument allowed so far
                }

                $methodName = $method->getName();
                $params = $method->getParameters();
                $firstParam = reset($params);
                $type = $firstParam->getType();
                if ($type !== null
                    && !$type->isBuiltin()
                    && $firstParam->getClass()->name === $eventType
                ) {
                    $listener->$methodName($event);
                }
            }
        }
    }

    public function addListener(object $listener): void
    {
        $this->listeners[] = $listener;
    }
}