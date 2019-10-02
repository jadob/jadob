<?php

namespace Jadob\Security\Auth\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\Command\GeneratePasswordHashCommand;
use Jadob\Security\Auth\EventListener\UserRefreshListener;
use Jadob\Security\Auth\UserStorage;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @todo rewrite to use supervisors and identityproviders/ identitystorage
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function register($config)
    {
        return [
            'auth.user.storage' => function (Container $container) {
                return new UserStorage($container->get(SessionInterface::class));
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {

        $container
            ->get('event.listener')
            ->addListener(
                new UserRefreshListener(
                    $container->get('guard'),
                    $container->get('auth.user.storage')
                ), 22
            );


        if ($container->has('console')) {
            /** @var Application $console */
            $console = $container->get('console');

            $console->add(new GeneratePasswordHashCommand());
        }
    }
}