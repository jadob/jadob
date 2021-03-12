<?php
declare(strict_types=1);

namespace Jadob\Dashboard\ServiceProvider;


use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Dashboard\Bridge\Jadob\JadobUrlGenerator;
use Jadob\Dashboard\Component\BigNumberComponent;
use Jadob\Dashboard\Component\ComponentProcessor;
use Jadob\Dashboard\Configuration\DashboardConfiguration;
use Jadob\Dashboard\ObjectManager\DoctrineOrmObjectManager;
use Jadob\Dashboard\PathGenerator;
use Jadob\Dashboard\Twig\DashboardExtension;
use Jadob\Dashboard\Twig\DashboardRoutingExtension;
use Jadob\Dashboard\UrlGeneratorInterface;
use Jadob\Router\Router;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DashboardProvider implements ServiceProviderInterface
{

    public function getConfigNode()
    {
        return 'dashboard';
    }

    public function register($config)
    {
        return [
            DashboardConfiguration::class => static function () use ($config): DashboardConfiguration {
                return DashboardConfiguration::fromArray($config);
            },
            ComponentProcessor::class => static function (ContainerInterface $container): ComponentProcessor {
                return new ComponentProcessor($container);
            },
            DoctrineOrmObjectManager::class => static function (ContainerInterface $container): DoctrineOrmObjectManager {
                return new DoctrineOrmObjectManager($container->get('doctrine.orm.default'));
            },
            BigNumberComponent::class => static function (): BigNumberComponent {
                return new BigNumberComponent();
            },
            UrlGeneratorInterface::class => static function (ContainerInterface $container): JadobUrlGenerator {
                return new JadobUrlGenerator($container->get('router'));
            },
            PathGenerator::class => static function (ContainerInterface $container): PathGenerator {
                return new PathGenerator($container->get(UrlGeneratorInterface::class));
            }
        ];
    }

    /**
     * @param Container $container
     * @param array|null $config
     * @throws ServiceNotFoundException
     * @throws \Jadob\Container\Exception\ContainerException
     * @throws \Twig\Error\LoaderError
     */
    public function onContainerBuild(Container $container, $config)
    {
        if ($container->has(Environment::class)) {
            $twig = $container->get(Environment::class);

            $loader = $twig->getLoader();
            if ($loader instanceof FilesystemLoader) {
                $loader->addPath(__DIR__ . '/../templates', 'JadobDashboard');
            }

            $twig->addExtension(new DashboardExtension($container->get(ComponentProcessor::class)));
            $twig->addExtension(new DashboardRoutingExtension($container->get(PathGenerator::class)));
        }
    }
}