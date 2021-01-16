<?php

declare(strict_types=1);

namespace Jadob\Security\Supervisor\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\IdentityStorage;
use Jadob\Security\Auth\ServiceProvider\AuthProvider;
use Jadob\Security\Supervisor\EventListener\SupervisorListener;
use Jadob\Security\Supervisor\Supervisor;
use Monolog\Logger;
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

                /** @noinspection MissingService */
                $logger = new Logger('supervisor', [
                    $container->get('logger.handler.default')
                ]);

                $supervisor = new Supervisor($logger);
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
     * @throws ServiceNotFoundException|\Jadob\Container\Exception\ContainerException
     */
    public function onContainerBuild(Container $container, $config)
    {

        /** @var Supervisor $supervisor */
        $supervisor = $container->get(Supervisor::class);
        /** @var IdentityStorage $identityStorage */
        $identityStorage = $container->get('auth.user.storage');
        $container->get(EventDispatcherInterface::class)->addListener(
            new SupervisorListener($supervisor, $identityStorage)
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