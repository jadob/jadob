<?php

namespace Slice\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractEvent
{

    protected $stopPropagation = false;

    abstract public function dispatch(Request $request, Response $response);

    /**
     * @return bool
     */
    public function isStopPropagation()
    {
        return $this->stopPropagation;
    }

    /**
     * @param bool $stopPropagation
     * @return Event
     */
    public function setStopPropagation($stopPropagation)
    {
        $this->stopPropagation = $stopPropagation;
        return $this;
    }


}