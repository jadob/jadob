<?php

namespace Jadob\TwigBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\TwigBridge\Twig\Extension\AssetExtension;
use Jadob\TwigBridge\Twig\Extension\DebugExtension;
use Jadob\TwigBridge\Twig\Extension\PathExtension;

/**
 * Class TwigServiceProvider
 * @package Jadob\TwigBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TwigServiceProvider implements ServiceProviderInterface
{

    /**
     * @return string
     */
    public function getConfigNode()
    {
        return 'twig';
    }

    /**
     * {@inheritdoc}
     */
    public function register(ContainerBuilder $container, $config)
    {
        return null;
    }

    /**
     * @param array[] $config
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Twig\Error\LoaderError
     */
    public function onContainerBuild(Container $container, $config)
    {

        /** @var BootstrapInterface $bootstrap */
        $bootstrap = $container->get('bootstrap');

        $loader = new \Twig_Loader_Filesystem();

        foreach ($config['templates_paths'] as $key => $path) {
            $loader->addPath($bootstrap->getRootDir() . '/' . $path, $key);
        }

        $cache = false;
        if ($config['cache']) {
            $cache = $bootstrap->getCacheDir() . '/twig';
        }

        $twig = new \Twig_Environment($loader, [
            'cache' => $cache,
            'strict_variables' => $config['strict_variables']
        ]);

        #TODO: create some utility class
        $appVariables = [
            'router' => $container->get('router'),
            'request' => $container->get('request'),
            'user' => $container->get('auth.user.storage'),
            'flashes' => $container->get('session')->getFlashBag()
        ];

        if(isset($config['globals']) && \is_array($config['globals'])) {
            foreach ($config['globals'] as $globalKey => $globalValue) {
                $twig->addGlobal($globalKey, $globalValue);
            }
        }

        $twig->addGlobal('app', $appVariables);

        $twig->addExtension(new AssetExtension($container->get('request')));
        $twig->addExtension(new PathExtension($container->get('router')));
        $twig->addExtension(new DebugExtension());

        $container->add('twig', $twig);
    }
}