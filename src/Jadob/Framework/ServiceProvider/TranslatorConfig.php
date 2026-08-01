<?php

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;

final class TranslatorConfig implements ConfigNodeInterface
{
    private(set) ?string $locale = null;

    private(set) bool $loggingEnabled = false;

    public function enableLogging(): bool
    {
        $this->loggingEnabled = true;
    }

    public function withLocale(string $locale): self
    {
        $this->locale = $locale;
    }
}