<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\ServiceProvider;

use Closure;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\Command\GeneratePasswordHashCommand;
use Jadob\Security\Auth\IdentityStorage;
use Symfony\Component\Console\Application;

/**
 * @deprecated
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

    }
}