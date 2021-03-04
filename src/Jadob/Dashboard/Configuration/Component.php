<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


class Component
{
    protected string $title;
    protected string $provider;
    protected ?int $span;
    protected array $context;

    public function __construct(string $title, string $provider, ?int $span, array $context = [])
    {
        $this->title = $title;
        $this->provider = $provider;
        $this->span = $span;
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getSpan(): ?int
    {
        return $this->span;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }


}