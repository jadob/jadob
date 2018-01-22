<?php

namespace Slice\EventListener\Event;


use Symfony\Component\HttpFoundation\Response;

class AfterControllerEvent implements EventParameterInterface
{

    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
       return $this->response;
    }
}