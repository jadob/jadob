<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class WebhookInfo
{
    protected ?string $url = null;


    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->url = $data['url'] ?? null;

        return $self;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return WebhookInfo
     */
    public function setUrl(?string $url): WebhookInfo
    {
        $this->url = $url;
        return $this;
    }
}