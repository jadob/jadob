<?php

declare(strict_types=1);

namespace Jadob\Core\Event;

use Jadob\Core\RequestContext;
use Psr\EventDispatcher\StoppableEventInterface;
use Symfony\Component\HttpFoundation\Response;

class RequestEvent implements StoppableEventInterface
{
    /**
     * @var Response|null
     */
    protected ?Response $response = null;

    public function __construct(
        protected RequestContext $requestContext
    ) {
    }

    public function getRequestContext(): RequestContext
    {
        return $this->requestContext;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }

    public function isPropagationStopped(): bool
    {
        return $this->response !== null;
    }
}