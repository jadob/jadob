<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;


class MessageEntity
{

    protected ?string $type = null;
    protected ?int $offset = null;
    protected ?int $length = null;


    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->type = $data['type'] ?? null;
        $self->offset = $data['offset'] ?? null;
        $self->length = $data['length'] ?? null;

        return $self;
    }
}