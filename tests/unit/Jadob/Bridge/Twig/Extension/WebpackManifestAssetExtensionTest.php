<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Twig\TwigFunction;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class WebpackManifestAssetExtensionTest extends TestCase
{
    public function testExtensionReturnsTwigFunction(): void
    {
        $extension = new WebpackManifestAssetExtension([]);
        $functions = $extension->getFunctions();
        /** @var TwigFunction $function */
        $function = reset($functions);

        self::assertCount(1, $functions);
        self::assertInstanceOf(TwigFunction::class, $function);
    }

    public function testExtensionCanProperlyReturnValues(): void
    {
        $extension = new WebpackManifestAssetExtension(
            ['styles.css' => 'styles.1234qwer.css']
        );

        $functions = $extension->getFunctions();
        /** @var TwigFunction $function */
        $function = reset($functions);

        self::assertEquals('webpack_manifest_asset', $function->getName());
    }


    public function testExtensionWillBreakWhenNoAssetFound(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Could not find "index.js" in webpack manifest file');

        $extension = new WebpackManifestAssetExtension(
            ['styles.css' => 'styles.2345.css']
        );

        $extension->getAssetFromManifest('index.js');
    }
}