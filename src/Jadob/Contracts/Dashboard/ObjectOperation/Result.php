<?php
declare(strict_types=1);

namespace Jadob\Contracts\Dashboard\ObjectOperation;


class Result
{
    public function __construct(
        protected bool $success,
        protected array $messages = []
    )
    {
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}