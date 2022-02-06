<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

class File
{
    protected ?string $fileId = null;
    protected ?string $fileUniqueId = null;
    protected ?string $filePath = null;
    protected ?int $fileSize = null;

    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->fileId = $data['file_id'] ?? null;
        $self->fileUniqueId = $data['file_unique_id'] ?? null;
        $self->filePath = $data['file_path'] ?? null;
        $self->fileSize = $data['file_size'] ?? null;

        return $self;
    }

    /**
     * @return string|null
     */
    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
}