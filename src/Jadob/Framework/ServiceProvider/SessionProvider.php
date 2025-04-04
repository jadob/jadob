<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\Session\SessionHandlerFactory;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

class SessionProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            SessionHandlerFactory::class => function () {
                return new SessionHandlerFactory();
            },

            SessionStorageInterface::class => function (ContainerInterface $container) {
                /** @var SessionHandlerFactory $sessionHandlerFactory */
                $sessionHandlerFactory = $container->get(SessionHandlerFactory::class);
                return new NativeSessionStorage(
                    [],
                    $sessionHandlerFactory->create()
                );
            }
        ];
    }
}