<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class Update
{
    protected ?int $id = null;
    protected ?Message $message = null;


    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['update_id'] ?? null;

        if(isset($data['message'])) {
            $self->message = Message::fromArray($data['message']);
        }


        return $self;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}