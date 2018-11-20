<?php

namespace Jadob\EventListener\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BeforeControllerEvent
 * @package Jadob\EventListener\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class BeforeControllerEvent
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * BeforeControllerEvent constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response = null)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return BeforeControllerEvent
     */
    public function setRequest(Request $request): BeforeControllerEvent
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return BeforeControllerEvent
     */
    public function setResponse(Response $response): BeforeControllerEvent
    {
        $this->response = $response;
        return $this;
    }
}