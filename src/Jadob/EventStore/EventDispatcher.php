<?php
declare(strict_types=1);

namespace Jadob\EventStore;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class EventDispatcher
{

    protected $listeners = [];

    public function emit(object $event)
    {
        $eventType = \get_class($event);
        foreach ($this->listeners as $listener) {
            $listenerReflection = new \ReflectionClass($listener);
            foreach ($listenerReflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
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

    public function addListener(object $listener)
    {
        $this->listeners[] = $listener;
    }
}