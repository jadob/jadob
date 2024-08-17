<?php
declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Translation;

/**
 * Do not rely on this class as it is internal.
 * Internal things are not supposed to use outside of the framework codebase and may be removed in any time.
 *
 * @internal
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class TranslationSource
{
    /**
     * TranslationSource constructor.
     * @param $path
     * @param $locale
     * @param $domain
     * @param string $path
     * @param string $locale
     * @param string $domain
     */
    public function __construct(private readonly string $path, private readonly string $locale, private readonly string $domain)
    {
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }
}