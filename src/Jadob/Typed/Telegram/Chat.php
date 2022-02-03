<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class Chat
{
    protected ?string $username = null;

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->username = $data['username'] ?? null;

        return $self;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return Chat
     */
    public function setUsername(?string $username): Chat
    {
        $this->username = $username;
        return $this;
    }
}