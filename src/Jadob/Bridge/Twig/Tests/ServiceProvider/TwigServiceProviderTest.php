<?php

namespace Jadob\Bridge\Twig\Tests\ServiceProvider;

use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use Jadob\Bridge\Twig\ServiceProvider\TwigServiceProvider;
use Jadob\Container\Container;
use Jadob\Core\AbstractBootstrap;
use Jadob\Core\BootstrapInterface;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class Bootstrap extends AbstractBootstrap {

    /**
     * Returns project root directory.
     * @return string
     */
    public function getRootDir(): string
    {
        return __DIR__;
    }

    /**
     * Returns array of Service providers that will be load while framework bootstrapping.
     * @return array
     */
    public function getServiceProviders(): array
    {
        return [];
    }
}

/**
 * Class TwigServiceProviderTest
 * @package Jadob\Bridge\Twig\Tests\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TwigServiceProviderTest extends TestCase
{

    public function testGettingConfigNode()
    {
        $provider = new TwigServiceProvider();

        $this->assertEquals('twig', $provider->getConfigNode());
    }


    public function testServicesRegisteringWithoutCache()
    {

        $provider = new TwigServiceProvider();
        $bootstrap = new Bootstrap();

        $services = $provider->register([
            'cache' => false,
            'strict_variables' => true,
            'templates_paths' => [
                'JadobTest' => '../../templates'
            ],
            'globals' => [
                'test1' => 'test1',
                'test2' => 'test2'
            ]
        ]);

        $this->assertCount(2, $services);
        $this->assertInstanceOf(\Closure::class, $services[LoaderInterface::class]);

        $container = new Container([BootstrapInterface::class => $bootstrap]);
        $loader = $services[LoaderInterface::class]($container);

        $this->assertInstanceOf(LoaderInterface::class, $loader);

        $container->add(LoaderInterface::class, $loader);
        $environment = $services[Environment::class]($container);

        $this->assertInstanceOf(Environment::class, $environment);


    }

    public function testServicesRegisteringWithCache()
    {

        $provider = new TwigServiceProvider();
        $bootstrap = new Bootstrap();

        $services = $provider->register([
            'cache' => true,
            'strict_variables' => true,
            'templates_paths' => [
                'JadobTest' => '../../templates'
            ],
            'globals' => [
                'test1' => 'test1',
                'test2' => 'test2'
            ]
        ]);

        $container = new Container([BootstrapInterface::class => $bootstrap]);
        $loader = $services[LoaderInterface::class]($container);

        $container->add(LoaderInterface::class, $loader);
        $environment = $services[Environment::class]($container);

        $this->assertInstanceOf(Environment::class, $environment);
    }


    public function testOnContainerBuild()
    {
        $provider = new TwigServiceProvider();
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
        $loader = $services[LoaderInterface::class]($container);

        $container->add(LoaderInterface::class, $loader);
        /** @var Environment $environment */
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