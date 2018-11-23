<?php

namespace Jadob\SymfonyFormBridge\ServiceProvider;


use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

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
    public function register(ContainerBuilder $container, $config)
    {
        // TODO: Implement register() method.
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($container->get('session'));
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $container->add('symfony.csrf.token.manager', $csrfManager);

    }
}