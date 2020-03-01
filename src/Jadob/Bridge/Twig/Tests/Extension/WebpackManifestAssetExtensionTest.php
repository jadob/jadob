<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Tests\Extension;

use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Twig\TwigFunction;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class WebpackManifestAssetExtensionTest extends TestCase
{

    public function testExtensionReturnsTwigFunction()
    {
        $extension = new WebpackManifestAssetExtension([]);
        $functions = $extension->getFunctions();
        /** @var TwigFunction $function */
        $function = reset($functions);

        $this->assertCount(1, $functions);
        $this->assertInstanceOf(TwigFunction::class, $function);

    }

    public function testExtensionCanProperlyReturnValues()
    {
        $extension = new WebpackManifestAssetExtension(
            ['styles.css' => 'styles.1234qwer.css']
        );

        $functions = $extension->getFunctions();
        /** @var TwigFunction $function */
        $function = reset($functions);

        $this->assertEquals('asset_from_manifest', $function->getName());
        $this->assertEquals('styles.1234qwer.css', $function->getCallable()('styles.css'));
        $this->assertEquals('styles.1234qwer.css', $extension->getAssetFromManifest('styles.css'));
    }


    public function testExtensionWillBreakWhenNoAssetFound()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Could not find "index.js" in webpack manifest file');

        $extension = new WebpackManifestAssetExtension(
            ['styles.css' => 'styles.2345.css']
        );

        $extension->getAssetFromManifest('index.js');
    }
}