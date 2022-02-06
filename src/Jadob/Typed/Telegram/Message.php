<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class Message
{
    protected ?array $photo = null;

    public static function fromArray(array $data): self
    {
        $self = new self();

        if (isset($data['photo'])) {
            $self->photo = [];
            foreach ($data['photo'] as $photo) {
                $self->photo[] = PhotoSize::fromArray($photo);
            }
        }

        return $self;
    }

    public function hasPhoto(): bool
    {
        return $this->photo !== null || (is_array($this->photo) && count($this->photo) === 0);
    }
}