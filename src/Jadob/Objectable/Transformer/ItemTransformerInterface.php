<?php

declare(strict_types=1);

namespace Jadob\Objectable\Transformer;

/**
 * Allows to handle specific use-cases, which may be hard to achieve by just using Field attributes.
 * @license MIT
 */
interface ItemTransformerInterface
{
    public function supports(string $className, string $context): bool;

    public function process(object $object): array;
}