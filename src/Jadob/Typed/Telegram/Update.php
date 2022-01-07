<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;


class Update
{

    protected ?int $id = null;

    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['update_id'] ?? null;
        return $self;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}