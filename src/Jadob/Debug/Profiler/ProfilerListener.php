<?php

namespace Jadob\Debug\Profiler;

use Jadob\EventListener\AbstractEvent;
use Symfony\Component\HttpFoundation\Response;

class ProfilerListener extends AbstractEvent
{

    /**
     * @TODO we should return if ajax request detected
     * @param Response $response
     * @return Response
     */
    public function onAfterControllerAction(Response $response)
    {
        return $response;
    }

    public function isEventStoppingPropagation()
    {
        return true;
    }
}