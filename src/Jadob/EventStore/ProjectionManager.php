<?php

declare(strict_types=1);

namespace Jadob\EventStore;

use Psr\Log\LoggerInterface;

/**
 * @deprecated to be replaced with Event Dispatcher
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class ProjectionManager
{
    protected $projections = [];
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function addProjection(object $projector)
    {
        $this->projections[get_class($projector)] = $projector;
        return $this;
    }

    public function emit(object $event): void
    {
        $projectionsNotified = 0;
        $eventType = \get_class($event);
        foreach ($this->projections as $listener) {
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
                    && $firstParam->getClass()->name === $eventType) {
                    $listener->$methodName($event);
                    $projectionsNotified++;
                }
            }
        }

        if($projectionsNotified === 0) {
            $this->logger->notice('There is no projections for '.$eventType.' Class.');
        }
    }
}