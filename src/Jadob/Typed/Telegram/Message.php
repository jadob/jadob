<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class Message
{
    protected ?int $id = null;
    protected ?User $from = null;
    protected ?array $photo = null;
    protected ?string $text = null;
    protected ?int $date = null;
    protected ?Chat $chat = null;
    protected array $entities = [];

    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['message_id'] ?? null;
        $self->date = $data['date'] ?? null;
        $self->text = $data['text'] ?? null;

        if (isset($data['from'])) {
            $self->from = User::fromArray($data['from']);
        }

        if(isset($data['chat'])) {
            $self->chat = Chat::fromArray($data['chat']);
        }

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