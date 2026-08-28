<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use RuntimeException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use function file_get_contents;
use function json_decode;

/**
 * @see     https://www.npmjs.com/package/webpack-manifest-plugin
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final class WebpackManifestAssetExtension extends AbstractExtension
{
    /**
     * @var string[]
     */
    protected array $manifest;

    private bool $loaded = false;

    public function __construct(
        private string $manifestPath
    )
    {
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('webpack_manifest_asset', $this->getAssetFromManifest(...))
        ];
    }

    /**
     * @param string $assetName
     * @return string
     * @throws RuntimeException
     */
    public function getAssetFromManifest(string $assetName): string
    {
        $this->loadManifest();
        if (isset($this->manifest[$assetName])) {
            return $this->manifest[$assetName];
        }

        throw new RuntimeException(
            sprintf('Could not find "%s" in webpack manifest file', $assetName)
        );
    }

    private function loadManifest(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->loaded = true;
        $this->manifest = json_decode(
            file_get_contents(
                $this->manifestPath
            ),
            true
        );
    }
}