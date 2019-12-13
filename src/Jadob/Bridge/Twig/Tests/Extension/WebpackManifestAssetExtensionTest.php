<?php

namespace Jadob\Bridge\Twig\Tests\Extension;

use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use PHPUnit\Framework\TestCase;

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
        /**
 * @var \Twig_SimpleFunction $function 
*/
        $function = reset($functions);

        $this->assertCount(1, $functions);
        $this->assertInstanceOf(\Twig_SimpleFunction::class, $function);

    }

    public function testExtensionCanProperlyReturnValues()
    {

        $extension = new WebpackManifestAssetExtension(
            [
            'styles.css' => 'styles.1234qwer.css'
            ]
        );

        $functions = $extension->getFunctions();
        /**
 * @var \Twig_SimpleFunction $function 
*/
        $function = reset($functions);

        $this->assertEquals('asset_from_manifest', $function->getName());
        $this->assertEquals('styles.1234qwer.css', $function->getCallable()('styles.css'));
        $this->assertEquals('styles.1234qwer.css', $extension->getAssetFromManifest('styles.css'));
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage Could not find "index.js" in webpack manifest file
     */
    public function testExtensionWillBreakWhenNoAssetFound()
    {
        $extension = new WebpackManifestAssetExtension(
            [
            'styles.css' => 'styles.2345.css'
            ]
        );

        $extension->getAssetFromManifest('index.js');

    }
}