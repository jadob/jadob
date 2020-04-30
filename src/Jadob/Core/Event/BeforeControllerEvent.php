<?php
declare(strict_types=1);

namespace Jadob\Core\Event;

use Jadob\Core\RequestContext;
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
     * @var RequestContext
     */
    protected RequestContext $context;

    /**
     * @var Response|null
     */
    protected ?Response $response = null;

    /**
     * @param RequestContext $context
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
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
        return $this->context->getRequest();
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * @return RequestContext
     */
    public function getContext(): RequestContext
    {
        return $this->context;
    }

    /**
     * {@inheritdoc}
     */
    public function isPropagationStopped(): bool
    {
        return $this->response !== null;
    }
}