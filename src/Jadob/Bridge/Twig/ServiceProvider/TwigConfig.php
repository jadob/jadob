<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;

final class TwigConfig implements ConfigNodeInterface
{
    public function __construct(
        private(set) bool $cache,
        private(set) bool $strictVariables,
        private(set) array $templatePaths,
        private(set) array $globals = [],
        private(set) ?ViteManifestExtensionConfig $viteManifestExtensionConfig = null,
        private(set) ?WebpackManifestExtensionConfig $webpackManifestExtensionConfig = null
    ) {
    }

    public function enableCaching(): self
    {
        $this->cache = true;

        return $this;
    }

    /**
     * Must be relative to project root.
     * @param string $path
     * @return $this
     */
    public function withTemplatePath(
        string $path,
    ): self {
        $this->templatePaths[] = $path;

        return $this;
    }

    public function enableStrictVariables(): self
    {
        $this->strictVariables = true;

        return $this;
    }

    public function configureViteManifestExtension(): ViteManifestExtensionConfig
    {
        $this->viteManifestExtensionConfig = new ViteManifestExtensionConfig();

        return $this->viteManifestExtensionConfig;
    }

    public function configureWebpackManifestExtension(): WebpackManifestExtensionConfig
    {
        $this->webpackManifestExtensionConfig = new WebpackManifestExtensionConfig();

        return $this->webpackManifestExtensionConfig;
    }
}