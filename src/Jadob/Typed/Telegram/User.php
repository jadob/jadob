<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class User
{
    protected ?int $id = null;
    protected ?bool $bot = null;
    protected ?string $firstName = null;
    protected ?string $lastName = null;
    protected ?string $username = null;
    protected ?string $languageCode = null;

    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['id'] ?? null;
        $self->bot = $data['is_bot'] ?? null;
        $self->firstName = $data['first_name'] ?? null;
        $self->lastName = $data['last_name'] ?? null;
        $self->username = $data['username'] ?? null;
        $self->languageCode = $data['language_code'] ?? null;

        return $self;
    }
}