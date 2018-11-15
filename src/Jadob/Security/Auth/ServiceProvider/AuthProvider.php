<?php

namespace Jadob\Security\Auth\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\UserStorage;

/**
 * Class AuthProvider
 * @package Jadob\Security\Auth\ServiceProvider
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
        return 'framework';
    }

    /**
     * {@inheritdoc}
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \RuntimeException
     */
    public function register(Container $container, $config)
    {
        if (!$container->has('session')) {
            throw new \RuntimeException('There is no "session" service in container. Please add SessionProvider before AuthProvider in your Bootstrap file.');
        }

        $container->add(
            'user.storage',
            new UserStorage(
                $container->get('session'), null
            )
        );
    }
}