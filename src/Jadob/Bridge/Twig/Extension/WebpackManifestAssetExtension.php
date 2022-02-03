<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use RuntimeException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @see     https://www.npmjs.com/package/webpack-manifest-plugin
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class WebpackManifestAssetExtension extends AbstractExtension
{
    /**
     * @var string[]
     */
    protected $manifest;

    /**
     * WebpackManifestAssetExtension constructor.
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
    public function getFunctions()
    {
        return [
            new TwigFunction('asset_from_manifest', [$this, 'getAssetFromManifest'])
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

        throw new RuntimeException('Could not find "' . $assetName . '" in webpack manifest file');
    }
}