<?php
declare(strict_types=1);

namespace Jadob\Objectable\Transformer;

/**
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
interface ValueTransformerInterface
{
    /**
     * @param mixed $value any value got from object
     * @param string $className
     * @param string $propertyName
     * @param bool $stopPropagation
     * @return string
     */
    public function transform($value, string $className, string $propertyName, bool &$stopPropagation): string;
}