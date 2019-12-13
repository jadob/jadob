<?php

namespace Jadob\Core\Event;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class AfterControllerEvent
{

    /**
     * @var Response
     */
    protected $response;

    /**
     * AfterControllerEvent constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param  Response $response
     * @return AfterControllerEvent
     */
    public function setResponse(Response $response): self
    {
        $this->response = $response;
        return $this;
    }
}