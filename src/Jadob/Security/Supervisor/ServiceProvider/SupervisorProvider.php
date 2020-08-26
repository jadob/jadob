<?php

declare(strict_types=1);

namespace Jadob\Security\Supervisor\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\ServiceProvider\AuthProvider;
use Jadob\Security\Supervisor\EventListener\SupervisorListener;
use Jadob\Security\Supervisor\Supervisor;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SupervisorProvider implements ServiceProviderInterface, ParentProviderInterface
{

    /**
     * {@inheritDoc}
     *
     * @return string|null
     */
    public function getConfigNode()
    {
        return 'supervisor';
    }

    /**
     * Here you can define things that will be registered in Container.
     *
     * @param array[]|null $config
     * @return array
     */
    public function register($config)
    {
        return [
            Supervisor::class => static function (ContainerInterface $container) use ($config) {

                $supervisor = new Supervisor();
                foreach ($config['supervisors'] as $supervisorName => $supervisorConfig) {
                    $supervisor->addRequestSupervisor(
                        $supervisorName,
                        $container->get($supervisorConfig['service']),
                        $container->get($supervisorConfig['user_provider'])
                    );
                }

                return $supervisor;
            }
        ];
    }

    /**
     * {@inheritDoc}
     *
     * @param Container $container
     * @param array|null $config the same config node as passed in register()
     * @return void
     * @throws ServiceNotFoundException
     */
    public function onContainerBuild(Container $container, $config)
    {
        $container->get(EventDispatcherInterface::class)->addListener(
            new SupervisorListener(
                $container->get(Supervisor::class),
                $container->get('auth.user.storage')
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getParentProviders()
    {
        return [
            AuthProvider::class
        ];
    }
}