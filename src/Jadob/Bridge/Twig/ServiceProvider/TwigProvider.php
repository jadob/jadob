<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\ServiceProvider;

use Closure;
use Jadob\Bridge\Twig\AppContext;
use Jadob\Bridge\Twig\Extension\AliasedAssetPathExtension;
use Jadob\Bridge\Twig\Extension\DebugExtension;
use Jadob\Bridge\Twig\Extension\PathExtension;
use Jadob\Bridge\Twig\Extension\ViteManifestAssetExtension;
use Jadob\Bridge\Twig\Extension\WebpackManifestAssetExtension;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Container\ServiceGraphContainer;
use Jadob\Container\ParameterStore;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
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
use function is_int;
use function json_decode;
use function ltrim;
use function sprintf;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class TwigProvider implements ServiceProviderInterface, ParentServiceProviderInterface, ConfigObjectProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): string
    {
        return 'twig';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param TwigConfig|ConfigNodeInterface|null $config
     * @return void
     */
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder
            ->set(FilesystemLoader::class)
            ->withFactory(
                static function (BootstrapInterface $bootstrap) use ($config): FilesystemLoader {
                    $loader = new FilesystemLoader();

                    // Adds Jadob namespace with some predefined templates (forms, alerts)
                    $loader->addPath(
                        dirname(new ReflectionClass(AppContext::class)->getFileName()) . '/templates',
                        'Jadob'
                    );

                    //@TODO: create some in-framework forms and remove twigbridge
                    //@TODO after refactoring, add some doc about integrating with twig-bridge
                    // Integrates with symfony/twig-bridge for default symfony forms
                    $twigBridgeDirectory = dirname(new ReflectionClass(TwigRendererEngine::class)->getFileName());
                    $formTemplatesDirectory = $twigBridgeDirectory . '/../Resources/views/Form';
                    $loader->addPath($formTemplatesDirectory);

                    foreach ($config->templatePaths as $key => $path) {
                        if (is_int($key)) {
                            $key = FilesystemLoader::MAIN_NAMESPACE;
                        }
                        $loader->addPath(
                            sprintf(
                                '%s/%s',
                                $bootstrap->getRootDir(),
                                ltrim($path, '/')
                            ),
                            $key
                        );
                    }

                    return $loader;
                }
            );


        $builder->bind(
            LoaderInterface::class,
            FilesystemLoader::class
        );



        $environmentClosure = static function (
            LoaderInterface $loader,
            BootstrapInterface $bootstrap,
        ) use ($config, $builder): Environment {
            $cache = false;

            if ($config->cache) {
                $cache = sprintf(
                    '%s/twig',
                    $bootstrap->getCacheDir()
                );
            }

            $options = [
                'cache' => $cache,
                'strict_variables' => $config->strictVariables,
                /**
                 * @TODO: should this parameter be hard-coded or customizable via config?
                 */
                'auto_reload' => true
            ];

            $environment = new Environment(
                $loader,
                $options
            );

            foreach ($config->globals as $key => $value) {
                $environment->addGlobal(
                    $key,
                    $value
                );
            }

            return $environment;
        };


        $builder->set(Environment::class)
            ->withFactory($environmentClosure);

        if($config->webpackManifestExtensionConfig !== null) {
            $webpackManifestConfig = $config->webpackManifestExtensionConfig;

            $builder
                ->set(WebpackManifestAssetExtension::class)
                ->withTag('twig.extension')
                ->withFactory(
                    function(BootstrapInterface $bootstrap) use ($webpackManifestConfig): WebpackManifestAssetExtension {
                        $manifestPath = sprintf(
                            '%s/%s',
                            rtrim($bootstrap->getRootDir(), '/'),
                            ltrim($webpackManifestConfig->manifestLocation, '/')
                        );

                        return new WebpackManifestAssetExtension(
                            manifestPath: $manifestPath
                        );
                    }
                );
        }
//
//
//        $services[PathExtension::class] = [
//            'tags' => ['twig.extension'],
//            'factory' => static function (Router $router): PathExtension {
//                return new PathExtension($router);
//            }
//        ];
//
//        $services[DebugExtension::class] = [
//            'tags' => ['twig.extension'],
//            'factory' => static function (): DebugExtension {
//                return new DebugExtension();
//            }
//        ];
//
//        $services[AliasedAssetPathExtension::class] = [
//            'tags' => ['twig.extension'],
//            'factory' => static function () use ($config): AliasedAssetPathExtension {
//                return new AliasedAssetPathExtension($config['extensions']['aliased_paths'] ?? []);
//            }
//        ];
//
//
//        /**
//         * @TODO: these two extension can be probably done better, in a less copy-and-paste-based manner!
//         */
//        if (isset($config['extensions']['webpack_manifest'])) {
//            $services['twig.webpack_manifest_extension'] = [
//                'tags' => ['twig.extension'],
//                'factory' => static function (ParameterStore $parameterStore) use ($config): WebpackManifestAssetExtension {
//                    $webpackManifestConfig = $config['extensions']['webpack_manifest'];
//                    $manifestJsonLocation =
//                        sprintf('%s/%s',
//                            $parameterStore->get('root_dir'),
//                            ltrim((string) $webpackManifestConfig['manifest_json_location'], '/')
//                        );
//
//                    $manifest = json_decode(
//                        file_get_contents($manifestJsonLocation),
//                        true,
//                        512,
//                        JSON_THROW_ON_ERROR
//                    );
//
//                    return new WebpackManifestAssetExtension($manifest);
//                }
//            ];
//        }
//
//        if (isset($config['extensions']['vite_manifest'])) {
//            $services['twig.vite_manifest_extension'] = [
//                'tags' => ['twig.extension'],
//                'factory' => static function (ParameterStore $parameterStore) use ($config): ViteManifestAssetExtension {
//                    $webpackManifestConfig = $config['extensions']['vite_manifest'];
//                    $manifestJsonLocation =
//                        sprintf('%s/%s',
//                            $parameterStore->get('root_dir'),
//                            ltrim((string) $webpackManifestConfig['manifest_json_location'], '/')
//                        );
//
//                    $manifest = json_decode(
//                        file_get_contents($manifestJsonLocation),
//                        true,
//                        512,
//                        JSON_THROW_ON_ERROR
//                    );
//
//                    return new ViteManifestAssetExtension($manifest);
//                }
//            ];
//        }
//
//
//        $services['twig.translator_extension'] = [
//            'tags' => ['twig.extension'],
//            'factory' => static function (TranslatorInterface $translator): TranslationExtension {
//                return new TranslationExtension(
//                    $translator
//                );
//            }
//        ];
//
//       // return $services;
    }

    public function getParentServiceProviders(): array
    {
        return [
            SymfonyTranslatorProvider::class
        ];
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new TwigConfig(
            cache: false,
            strictVariables: false,
            templatePaths: []
        );
    }
}