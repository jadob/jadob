<?php

namespace Jadob\Security\Supervisor\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Security\Supervisor\EventListener\SupervisorListener;
use Jadob\Security\Supervisor\Supervisor;
use Psr\Container\ContainerInterface;

class SupervisorProvider implements ServiceProviderInterface
{

    /**
     * returns Config node name that will be passed as $config in register() method.
     * return null if no config needed.
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
     */
    public function register($config)
    {
        return [
            Supervisor::class => function (ContainerInterface $container) use ($config) {

                $supervisor = new Supervisor();
                foreach ($config['supervisors'] as $supervisorName => $supervisorConfig) {
                    $supervisor->addRequestSupervisor(
                        $supervisorName,
                        $container->get($supervisorConfig['service']),
                        $container->get($supervisorConfig['provider'])
                    );
                }

                return $supervisor;
            }
        ];
    }

    /**
     * Stuff that's needed to be done after container is built.
     * What can you do using these method?
     * - This one gets container as a first argument, so, you can e.g. get all services implementing SomeCoolInterface,
     * and inject them somewhere
     * (example 1: using Twig, you can register all extensions)
     * (example 2: EventListener registers all Listeners here)
     * - You can add new services of course
     *
     * @param  Container  $container
     * @param  array|null $config    the same config node as passed in register()
     * @return void
     */
    public function onContainerBuild(Container $container, $config)
    {
        $container->get(EventDispatcher::class)->addListener(
            new SupervisorListener(
                $container->get(Supervisor::class),
                $container->get('auth.user.storage')
            )
        );
    }
}