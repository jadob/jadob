<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use RuntimeException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use function file_get_contents;
use function json_decode;

/**
 * @see https://www.npmjs.com/package/webpack-manifest-plugin
 */
final class WebpackManifestAssetExtension extends AbstractExtension
{

    public static function fromFile(
        string $manifestPath,
    ): WebpackManifestAssetExtension
    {
        return new self(
            json_decode(
                file_get_contents(
                   $manifestPath
                ),
                true
            )

        );

    }

    /**
     * @param array<non-empty-string, non-empty-string> $manifest
     */
    public function __construct(
        private array $manifest
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
        if (isset($this->manifest[$assetName])) {
            return $this->manifest[$assetName];
        }

        throw new RuntimeException(
            sprintf('Could not find "%s" in webpack manifest file', $assetName)
        );
    }
}