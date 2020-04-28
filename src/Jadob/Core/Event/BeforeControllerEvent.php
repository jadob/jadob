<?php

namespace Jadob\Core\Event;

use Psr\EventDispatcher\StoppableEventInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class BeforeControllerEvent implements StoppableEventInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response|null
     */
    protected $response;

    /**
     * BeforeControllerEvent constructor.
     * @TODO: RequextContext should be passed here instead of Request object
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Please keep in mind that setting an response object in event will terminate the propagation of event and
     * the rest of request execution, and passed request will be returned to user.
     *
     * @param Response $response
     */
    public function setResponse(Response $response): void
    {
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
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * {@inheritdoc}
     */
    public function isPropagationStopped(): bool
    {
        return $this->response !== null;
    }
}