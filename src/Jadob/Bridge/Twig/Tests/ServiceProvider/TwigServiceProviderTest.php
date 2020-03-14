<?php

namespace Jadob\Bridge\Twig\Tests\ServiceProvider;

use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use Jadob\Bridge\Twig\ServiceProvider\TwigProvider;
use Jadob\Container\Container;
use Jadob\Core\AbstractBootstrap;
use Jadob\Core\BootstrapInterface;
use Jadob\Core\Kernel;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\LoaderInterface;



/**
 * Class TwigServiceProviderTest
 *
 * @package Jadob\Bridge\Twig\Tests\ServiceProvider
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class TwigServiceProviderTest extends TestCase
{

    public function testGettingConfigNode(): void
    {
        $provider = new TwigProvider();

        $this->assertEquals('twig', $provider->getConfigNode());
    }


    public function testServicesRegisteringWithoutCache(): void
    {

        $provider = new TwigProvider();
        $bootstrap = new Bootstrap();

        $services = $provider->register(
            [
            'cache' => false,
            'strict_variables' => true,
            'templates_paths' => [
                'JadobTest' => '../../templates'
            ],
            'globals' => [
                'test1' => 'test1',
                'test2' => 'test2'
            ]
            ]
        );

        $this->assertCount(2, $services);
        $this->assertInstanceOf(\Closure::class, $services[LoaderInterface::class]);

        $container = new Container([BootstrapInterface::class => $bootstrap]);
        $loader = $services[LoaderInterface::class]($container);

        $this->assertInstanceOf(LoaderInterface::class, $loader);

        $container->add(LoaderInterface::class, $loader);
        $environment = $services[Environment::class]($container);

        $this->assertInstanceOf(Environment::class, $environment);


    }

    /**
     * @throws \Jadob\Core\Exception\KernelException
     * @throws \Twig\Error\LoaderError
     *
     * @return void
     */
    public function testServicesRegisteringWithCache(): void
    {

        $provider = new TwigProvider();
        $bootstrap = new Bootstrap();

        $services = $provider->register(
            [
            'cache' => true,
            'strict_variables' => true,
            'templates_paths' => [
                'JadobTest' => '../../templates'
            ],
            'globals' => [
                'test1' => 'test1',
                'test2' => 'test2'
            ]
            ]
        );

        $container = new Container([BootstrapInterface::class => $bootstrap]);
        $container->add(Kernel::class, new Kernel('prod', $bootstrap));
        $loader = $services[LoaderInterface::class]($container);

        $container->add(LoaderInterface::class, $loader);
        $environment = $services[Environment::class]($container);

        $this->assertInstanceOf(Environment::class, $environment);
    }


    /**
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Jadob\Core\Exception\KernelException
     * @throws \Twig\Error\LoaderError
     *
     * @return void
     */
    public function testOnContainerBuild(): void
    {
        $provider = new TwigProvider();
        $bootstrap = new Bootstrap();

        $config = [
            'cache' => true,
            'strict_variables' => true,
            'templates_paths' => [
                'JadobTest' => '../../templates'
            ],
            'extensions' => [
                'webpack_manifest' => [
                    'manifest_json_location' => '../manifest.json'
                ]
            ]
        ];


        $services = $provider->register($config);

        $container = new Container([BootstrapInterface::class => $bootstrap]);
        $container->add(Kernel::class, new Kernel('prod', $bootstrap));
        $loader = $services[LoaderInterface::class]($container);

        $container->add(LoaderInterface::class, $loader);
        /**
 * @var Environment $environment 
*/
        $environment = $services[Environment::class]($container);
        $container->add(Environment::class, $environment);

        $provider->onContainerBuild($container, $config);

        $this->assertSame(
            $container->get(Environment::class),
            $container->get('twig')
        );

        $this->assertInstanceOf(
            WebpackManifestAssetExtension::class,
            $environment->getExtension(WebpackManifestAssetExtension::class)
        );
    }
}