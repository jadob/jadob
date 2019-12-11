<?php

namespace Jadob\Bridge\Symfony\Form\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

/**
 * @author  pizzaminded <miki@appvende.net>
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
     * {@inheritdoc}
     */
    public function register($config)
    {

        return [
            'symfony.csrf.token.manager' => function (Container $container) {
                $csrfGenerator = new UriSafeTokenGenerator();
                $csrfStorage = new SessionTokenStorage($container->get('session'));
                return new CsrfTokenManager($csrfGenerator, $csrfStorage);
            },
            'symfony.forms.csrf.extension' => function (Container $container) {
                return new CsrfExtension($container->get('symfony.csrf.token.manager'));
            }];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {


    }
}