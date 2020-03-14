<?php
declare(strict_types=1);

namespace Jadob\Contract\Translation;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface TranslatorInterface
{

    /**
     * @param string $key
     * @param array $arguments
     * @param string|null $group
     *
     * @return string
     */
    public function translate(
        string $key,
        array $arguments = [],
        string $group = null
    ): string;

    /**
     * @param string $locale
     */
    public function setLocale(
        string $locale
    ): void;

    /**
     * @param string $path
     * @param string $locale
     * @param string $type
     * @param string $group
     *
     * @return void
     */
    public function addSource(
        string $path,
        string $locale,
        string $type,
        string $group
    ): void;
}