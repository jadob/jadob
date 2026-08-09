<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\Session\SessionHandlerFactory;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

/**
 * @TODO: add session configuration
 */
final readonly class SessionProvider implements ServiceProviderInterface
{

    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder->set(SessionHandlerFactory::class);

        $builder
            ->set(NativeSessionStorage::class)
            ->factory(
                function (SessionHandlerFactory $factory) {
                    return new NativeSessionStorage(
                        [],
                        $factory->create()
                    );
                }
            );

        $builder->bind(SessionStorageInterface::class, NativeSessionStorage::class);
    }
}