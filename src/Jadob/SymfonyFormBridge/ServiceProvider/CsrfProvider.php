<?php

namespace Jadob\SymfonyFormBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

/**
 * Class CsrfProvider
 * @package Jadob\SymfonyFormBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class CsrfProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        // TODO: Implement getConfigNode() method.
    }

    /**
     * Here you can define things that will be registered in Container.
     * @param ContainerBuilder $container
     * @param array|null $config
     */
    public function register($config)
    {
        $container->add('symfony.csrf.token.manager', function (Container $container) {
            $csrfGenerator = new UriSafeTokenGenerator();
            $csrfStorage = new SessionTokenStorage($container->get('session'));
            return new CsrfTokenManager($csrfGenerator, $csrfStorage);
        });

        $container->add('symfony.forms.csrf.extension', function (Container $container) {
            return new CsrfExtension($container->get('symfony.csrf.token.manager'));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {


    }
}