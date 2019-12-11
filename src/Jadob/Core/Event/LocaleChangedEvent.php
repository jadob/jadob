<?php

namespace Jadob\Core\Event;

/**
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
class LocaleChangedEvent
{
    /**
     * @var string
     */
    protected $newLocale;

    /**
     * LocaleChangedEvent constructor.
     *
     * @param string $newLocale
     */
    public function __construct(string $newLocale)
    {
        $this->newLocale = $newLocale;
    }

    /**
     * @return string
     */
    public function getNewLocale(): string
    {
        return $this->newLocale;
    }
}