<?php

declare(strict_types=1);

namespace Jadob\Container\Exception;

use LogicException;
use Psr\Container\ContainerExceptionInterface;

class ContainerLogicException extends LogicException implements ContainerExceptionInterface
{
    public static function missingTypeHint(string $id): self
    {
        return new self(
            sprintf(
                'Unable to add service "%s" to container, as it has neither className or factory return hint defined.',
                $id
            )
        );
    }
}