<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;


class PhotoSize
{
    protected ?string $fileId = null;
    protected ?string $fileUniqueId = null;
    protected ?int $width = null;
    protected ?int $height = null;
    protected ?int $fileSize = null;

    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->fileId = $data['file_id'] ?? null;
        $self->fileUniqueId = $data['file_unique_id'] ?? null;
        $self->width = $data['width'] ?? null;
        $self->height = $data['height'] ?? null;
        $self->fileSize = $data['file_size'] ?? null;

        return $self;
    }

}