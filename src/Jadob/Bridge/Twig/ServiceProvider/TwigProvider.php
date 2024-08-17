<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\ServiceProvider;

use function file_get_contents;
use Jadob\Bridge\Twig\Extension\AliasedAssetPathExtension;
use Jadob\Bridge\Twig\Extension\DebugExtension;
use Jadob\Bridge\Twig\Extension\PathExtension;
use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Core\Kernel;
use function json_decode;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Twig\Environment;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class TwigProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'twig';
    }

    /**
     * {@inheritdoc}
     *
     * @return (\Closure|\Closure)[]
     *
     * @psalm-return array{Twig\Loader\LoaderInterface: \Closure(ContainerInterface):FilesystemLoader, Twig\Environment: \Closure(ContainerInterface):Environment}
     * @throws \Twig\Error\LoaderError
     *
     */
    public function register($config)
    {
        $loaderClosure = static function (ContainerInterface $container) use ($config): \Twig\Loader\FilesystemLoader {
            $loader = new FilesystemLoader();

            //Adds Jadob namespace with some predefined templates (forms, alerts)
            $loader->addPath(__DIR__ . '/../templates', 'Jadob');

            //@TODO: create some in-framework forms and remove twigbridge
            //@TODO after refactoring, add some doc about integrating with twig-bridge
            //Integrates with symfony/twig-bridge for default symfony forms
            $twigBridgeDirectory = dirname((new ReflectionClass(TwigRendererEngine::class))->getFileName());
            $formTemplatesDirectory = $twigBridgeDirectory . '/../Resources/views/Form';
            $loader->addPath($formTemplatesDirectory, FilesystemLoader::MAIN_NAMESPACE);

            foreach ($config['templates_paths'] as $key => $path) {
                if (\is_int($key)) {
                    $key = FilesystemLoader::MAIN_NAMESPACE;
                }
                $loader->addPath($container->get(BootstrapInterface::class)->getRootDir() . '/' . \ltrim($path, '/'), $key);
            }

            return $loader;
        };

        $environmentClosure = static function (ContainerInterface $container) use ($config): \Twig\Environment {
            $cache = false;

            if ($config['cache']) {
                $cache =
                    $container->get(BootstrapInterface::class)->getCacheDir()
                    . '/'
                    . $container->get(Kernel::class)->getEnv()
                    . '/twig';
            }

            $options = [
                'cache' => $cache,
                'strict_variables' => $config['strict_variables'],
                'auto_reload' => true
            ];

            $environment = new Environment(
                $container->get(LoaderInterface::class),
                $options
            );

            if (isset($config['globals']) && \is_array($config['globals'])) {
                foreach ($config['globals'] as $globalKey => $globalValue) {
                    $environment->addGlobal($globalKey, $globalValue);
                }
            }

            return $environment;
        };

        return [
            LoaderInterface::class => $loaderClosure,
            Environment::class => $environmentClosure
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        //@TODO: drop 'twig' alias
        $container->alias(Environment::class, 'twig');

        /** @var Environment $twig */
        $twig = $container->get(Environment::class);


        //@TODO: fix referencing to router
        if ($container->has('router')) {
            $twig->addExtension(new PathExtension($container->get('router')));
        }

        //@TODO this one should be disabled on prod
        $twig->addExtension(new DebugExtension());

        //register additional extensions provided with framework
        if (!isset($config['extensions'])) {
            return;
        }

        $extensions = $config['extensions'];

        //@TODO documentation
        if (isset($extensions['webpack_manifest'])) {
            $webpackManifestConfig = $extensions['webpack_manifest'];
            $rootDir = $container->get(BootstrapInterface::class)->getRootDir();

            //TODO Add tests when user will add / at the beginning
            $manifestJsonLocation = $rootDir . '/' . ltrim((string) $webpackManifestConfig['manifest_json_location'], '/');

            $manifest = json_decode(
                file_get_contents($manifestJsonLocation),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
            $twig->addExtension(new WebpackManifestAssetExtension($manifest));
        }

        $twig->addExtension(new AliasedAssetPathExtension($extensions['aliased_assets'] ?? []));

        //Register user-defined extensions:
        $extensions = $container->getObjectsImplementing(ExtensionInterface::class);
        foreach ($extensions as $extension) {
            //TODO: check if addExtensions() does not override currently added extensions and use it for lower complexity
            $twig->addExtension($extension);
        }
    }
}