<?php

namespace Jadob\TwigBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
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
     * @param Container $container
     * @param $config
     * @return mixed|void
     * @throws \Jadob\Container\Exception\ContainerException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Twig_Error_Loader
     */
    public function register(Container $container, $config)
    {
        /** @var \Bootstrap $bootstrap */
        $bootstrap = $container->get('bootstrap');

        $loader = new \Twig_Loader_Filesystem();
        foreach ($config['templates_paths'] as $key => $path) {
            $loader->addPath($bootstrap->getRootDir() . $path, $key);
        }

        $cache = false;
        if ($config['cache']) {
            $cache = $bootstrap->getCacheDir() . '/twig';
        }

        $twig = new \Twig_Environment($loader, [
            'cache' => $cache,
            'strict_variables' => $config['strict_variables']
        ]);


        $user = null;
        if($container->has('auth.user.storage')) {
            $user = $container->get('auth.user.storage')->getUser();
        }

        $appVariables = [
//            'current_route' => $container->get('router')->getCurrentRoute(),
            'router' => $container->get('router'),
            'request' => $container->get('request'),
            'user' => $user,
            'flashes' => $container->get('session')->getFlashBag()
        ];

        $twig->addGlobal('app', $appVariables);

        if(isset($config['globals'])) {
            foreach ($config['globals'] as $globalKey => $globalValue) {
                $twig->addGlobal($globalKey, $globalValue);
            }
        }

        $twig->addExtension(new AssetExtension($container->get('request')));
        $twig->addExtension(new PathExtension($container->get('router')));
        $twig->addExtension(new DebugExtension());

        $container->add('twig', $twig);
    }

}