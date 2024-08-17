<?php
declare(strict_types=1);

namespace Jadob\Objectable\Transformer;

/**
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
interface HeaderTransformerInterface
{
    /**
     * @param string $title
     * @param string $className
     * @param string $propertyName
     * @return string
     */
    public function transform(string $title, string $className, string $propertyName): string;
}