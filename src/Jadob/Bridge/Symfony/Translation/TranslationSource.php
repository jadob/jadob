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
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $locale;

    /**
     * @var string
     */
    private string $domain;

    /**
     * TranslationSource constructor.
     * @param $path
     * @param $locale
     * @param $domain
     */
    public function __construct($path, $locale, $domain)
    {
        $this->path = $path;
        $this->locale = $locale;
        $this->domain = $domain;
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