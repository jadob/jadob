<?php

declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class Chat
{
    protected ?int $id = null;
    protected ?string $firstName = null;
    protected ?string $lastName = null;
    protected ?string $username = null;
    protected ?string $type = null;

    /**
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->firstName = $data['first_name'] ?? null;
        $self->lastName = $data['last_name'] ?? null;
        $self->username = $data['username'] ?? null;
        $self->type = $data['type'] ?? null;

        return $self;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): Chat
    {
        $this->username = $username;

        return $this;
    }
}
