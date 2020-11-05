<?php

namespace Jadob\Security\Auth\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\Command\GeneratePasswordHashCommand;
use Jadob\Security\Auth\IdentityStorage;
use Symfony\Component\Console\Application;

/**
 * @todo    rewrite to use supervisors and identityproviders/ identitystorage
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class AuthProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     * @return void
     */
    public function getConfigNode(): void
    {
        return;
    }

    /**
     * {@inheritdoc}
     * @return \Closure[]
     * @psalm-return array{'auth.user.storage': pure-callable(\Jadob\Container\Container):\Jadob\Security\Auth\IdentityStorage}
     */
    public function register($config)
    {
        return [
            'auth.user.storage' => static function (): IdentityStorage {
                return new IdentityStorage();
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        if ($container->has('console')) {
            /** @var Application $console */
            $console = $container->get('console');

            $console->add(new GeneratePasswordHashCommand());
        }
    }
}