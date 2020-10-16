<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Tests\Fixtures;


use Psr\EventDispatcher\StoppableEventInterface;

class GenericStoppableEvent implements StoppableEventInterface
{

    protected bool $stopped;
    protected string $content;

    public function __construct(bool $stopped = true, string $content = '')
    {
        $this->stopped = $stopped;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }


    /**
     * @param bool $stopped
     */
    public function setStopped(bool $stopped): void
    {
        $this->stopped = $stopped;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }
}