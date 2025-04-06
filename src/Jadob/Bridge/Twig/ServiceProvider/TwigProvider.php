<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\ServiceProvider;

use Closure;
use Jadob\Bridge\Twig\AppContext;
use Jadob\Bridge\Twig\Extension\AliasedAssetPathExtension;
use Jadob\Bridge\Twig\Extension\DebugExtension;
use Jadob\Bridge\Twig\Extension\PathExtension;
use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use Jadob\Container\Container;
use Jadob\Container\ParameterStore;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Framework\ServiceProvider\SymfonyTranslatorProvider;
use Jadob\Router\Router;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;
use function file_get_contents;
use function json_decode;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class TwigProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): ?string
    {
        return 'twig';
    }

    /**
     * {@inheritdoc}
     *
     * @return (Closure|Closure)[]
     *
     * @psalm-return array{Twig\Loader\LoaderInterface: Closure(ContainerInterface):FilesystemLoader, Twig\Environment: Closure(ContainerInterface):Environment}
     * @throws \Twig\Error\LoaderError
     *
     */
    public function register(ContainerInterface $container, array|null|object $config = null): array
    {
        $loaderClosure = static function (Container $container) use ($config): FilesystemLoader {
            $loader = new FilesystemLoader();

            //Adds Jadob namespace with some predefined templates (forms, alerts)
            $loader->addPath(dirname((new ReflectionClass(AppContext::class))->getFileName()) . '/templates', 'Jadob');

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

        $environmentClosure = static function (
            LoaderInterface $loader,
            ParameterStore  $parameterStore,
            Container       $container,
        ) use ($config): Environment {
            $cache = false;

            if ($config['cache']) {
                $cache = sprintf(
                    '%s/twig',
                    $parameterStore->get('env_cache_dir')
                );
            }

            $options = [
                'cache' => $cache,
                'strict_variables' => $config['strict_variables'],
                'auto_reload' => true
            ];

            $environment = new Environment(
                $loader,
                $options
            );

            if (isset($config['globals']) && \is_array($config['globals'])) {
                foreach ($config['globals'] as $globalKey => $globalValue) {
                    $environment->addGlobal($globalKey, $globalValue);
                }
            }

            return $environment;
        };

        $services = [
            LoaderInterface::class => $loaderClosure,
            Environment::class => $environmentClosure,
        ];


        $services[PathExtension::class] = [
            'tags' => ['twig.extension'],
            'factory' => static function (Router $router): PathExtension {
                return new PathExtension($router);
            }
        ];

        $services[DebugExtension::class] = [
            'tags' => ['twig.extension'],
            'class' => DebugExtension::class
        ];

        $services[AliasedAssetPathExtension::class] = [
            'tags' => ['twig.extension'],
            'factory' => static function () use ($config): AliasedAssetPathExtension {
                return new AliasedAssetPathExtension($config['extensions']['aliased_paths'] ?? []);
            }
        ];

        if (isset($config['extensions']['webpack_manifest'])) {
            $services['twig.webpack_manifest_extension'] = [
                'tags' => ['twig.extension'],
                'factory' => static function (ParameterStore $parameterStore) use ($config): WebpackManifestAssetExtension {
                    $webpackManifestConfig = $config['extensions']['webpack_manifest'];
                    $manifestJsonLocation =
                        sprintf('%s/%s',
                            $parameterStore->get('root_dir'),
                            ltrim((string) $webpackManifestConfig['manifest_json_location'], '/')
                        );

                    $manifest = json_decode(
                        file_get_contents($manifestJsonLocation),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );

                    return new WebpackManifestAssetExtension($manifest);
                }
            ];
        }


        $services['twig.translator_extension'] = [
            'tags' => ['twig.extension'],
            'factory' => static function (TranslatorInterface $translator): TranslationExtension {
                return new TranslationExtension(
                    $translator
                );
            }
        ];

        return $services;
    }

    public function getParentServiceProviders(): array
    {
        return [
            SymfonyTranslatorProvider::class
        ];
    }
}