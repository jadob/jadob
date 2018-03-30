<?php

namespace Jadob\EventListener\Event;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class AfterControllerEvent
 * @package Jadob\EventListener\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AfterControllerEvent implements EventParameterInterface
{

    /**
     * @var Response
     */
    protected $response;

    /**
     * AfterControllerEvent constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
       return $this->response;
    }

    /**
     * @param Response $response
     * @return AfterControllerEvent
     */
    public function setResponse(Response $response): AfterControllerEvent
    {
        $this->response = $response;
        return $this;
    }

}