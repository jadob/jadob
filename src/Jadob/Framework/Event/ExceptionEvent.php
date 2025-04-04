<?php
declare(strict_types=1);

namespace Jadob\Framework\Event;

use Psr\EventDispatcher\StoppableEventInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ExceptionEvent implements StoppableEventInterface
{
    private $stopped = false;

    private ?Response $response = null;

    public function __construct(
        private Throwable $exception,
    ) {
    }

    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }


    public function stopPropagation(): void
    {
        $this->stopped = true;
    }

    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }

    /**
     * @return Throwable
     */
    public function getException(): Throwable
    {
        return $this->exception;
    }
}