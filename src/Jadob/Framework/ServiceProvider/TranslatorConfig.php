<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;

final class TranslatorConfig implements ConfigNodeInterface
{
    private(set) ?string $locale = null;

    private(set) bool $loggingEnabled = false;

    public function enableLogging(): self
    {
        $this->loggingEnabled = true;

        return $this;
    }

    public function withLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}