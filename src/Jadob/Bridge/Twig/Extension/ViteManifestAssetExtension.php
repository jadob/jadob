<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use RuntimeException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @see     https://vite.dev/guide/backend-integration
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ViteManifestAssetExtension extends AbstractExtension
{
    /**
     * @var string[]
     */
    protected array $manifest;

    /**
     *
     * @param string[] $manifest
     */
    public function __construct(array $manifest)
    {
        $this->manifest = $manifest;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('vite_manifest_asset', $this->getAssetFromManifest(...))
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
            return $this->manifest[$assetName]['file'];
        }

        throw new RuntimeException(
            sprintf('Could not find "%s" in vite manifest file', $assetName)
        );
    }
}