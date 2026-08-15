<?php

namespace Jadob\Bridge\Twig\ServiceProvider;

final class WebpackManifestExtensionConfig
{
    public function __construct(
        private(set) ?string $manifestLocation = null,
    )
    {
    }

    /**
     * Must be relative to project root.
     * @param string $location
     * @return $this
     */
    public function withManifestLocation(
        string $location,
    ): self
    {
        $this->manifestLocation = $location;
        return $this;
    }
}