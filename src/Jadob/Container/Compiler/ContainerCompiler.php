<?php

namespace Jadob\Container\Compiler;

use Closure;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Builder\NamespaceScanConfigurator;
use Jadob\Container\Compiler\Exception\CircularDependencyException;
use Jadob\Container\Compiler\Exception\MissingParentServiceProviderException;
use Jadob\Container\Compiler\Extension\AutowireServices;
use Jadob\Container\Compiler\Extension\ResolveFactoryArguments;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Container\Config\ConfigNodeFinder;
use Jadob\Container\Config\ConfigNodeFinderInterface;
use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ReferenceType;
use Jadob\Contracts\DependencyInjection\ServiceDefinition;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use MJS\TopSort\CircularDependencyException as TopSortCircularDependencyException;
use MJS\TopSort\ElementNotFoundException;
use MJS\TopSort\Implementations\StringSort;
use Roave\BetterReflection\BetterReflection;
use Roave\BetterReflection\Reflector\DefaultReflector;
use Roave\BetterReflection\SourceLocator\Type\DirectoriesSourceLocator;
use function array_map;
use function array_merge;
use function array_values;
use function get_class;

final class ContainerCompiler
{

    /**
     * @var array<CompilerExtensionEntry>
     */
    private array $extensions = [];

    /**
     * @param ConfigNodeFinderInterface $configNodeFinder
     */
    public function __construct(
        private ConfigNodeFinderInterface $configNodeFinder,
    )
    {
    }

    public function addExtension(
        CompilerExtensionInterface $extension,
        string $id,
        int $priority,
    ): void
    {
        $this->extensions[] = new CompilerExtensionEntry(
            extension: $extension,
            id: $id,
            priority: $priority,
        );

    }

    public function registerNativeExtensions(): void
    {
        $this->extensions[] = new CompilerExtensionEntry(
            extension: new ResolveFactoryArguments(),
            id: 'resolve_factory_arguments',
            priority: 1,
        );

        $this->extensions[] = new CompilerExtensionEntry(
            extension: new AutowireServices(),
            id: 'autowire',
            priority: 1,
        );
        
    }

    /**
     * @param ContainerBuilder $builder
     * @param array $parameters
     * @return void
     */
    public function compile(
        ContainerBuilder $builder,
    ): ServiceGraph
    {
        $serviceProviders = $builder
            ->getServiceProviders();

        $this->resolveServiceProviders(
            $builder,
            $serviceProviders,
        );

        $this->resolveConfigurations(
            $builder,
        );

        $this->processNamespaceScans(
            $builder
        );

        return $this->buildServiceGraph(
            $builder,
        );
    }

    /**
     * @param array<ServiceProviderInterface> $providers
     * @return array<ServiceProviderInterface> Topological sorted list of providers
     * @throws CircularDependencyException
     * @throws MissingParentServiceProviderException
     */
    private function calculateServiceProviderRegisterOrder(
        array $providers,
    ): array
    {
        try {
            $providersIndexed = [];
            $sorter = new StringSort();
            foreach ($providers as $provider) {
                $providerFqcn = get_class($provider);
                $providersIndexed[$providerFqcn] = $provider;

                $dependencies = [];
                if ($provider instanceof ParentServiceProviderInterface) {
                    $dependencies = $provider->getParentServiceProviders();
                }

                $sorter->add(
                    $providerFqcn,
                    $dependencies
                );
            }

            /** @var array<class-string> $result */
            $result = $sorter->sort();

            $output = [];
            foreach ($result as $providerFqcn) {
                $output[] = $providersIndexed[$providerFqcn];
            }

            return $output;

        } catch (TopSortCircularDependencyException $exception) {
            throw new CircularDependencyException(
                $exception->getMessage()
            );
        } catch (ElementNotFoundException $exception) {
            throw new MissingParentServiceProviderException(
                sprintf(
                    'Service provider "%s" requires provider "%s" to be registered but it was not found in container config.',
                    $exception->getSource(),
                    $exception->getTarget()
                )
            );
        }

    }

    /**
     * @param ContainerBuilder $builder
     * @param array<ServiceProviderInterface|(ServiceProviderInterface&ConfigObjectProviderInterface)> $providers
     * @return void
     * @throws CircularDependencyException
     * @throws MissingParentServiceProviderException
     */
    private function resolveServiceProviders(
        ContainerBuilder $builder,
        array            $providers,
    ): void
    {
        $serviceProviderOrder = $this
            ->calculateServiceProviderRegisterOrder(
                $providers,
            );

        foreach ($serviceProviderOrder as $provider) {
            if ($provider instanceof ConfigObjectProviderInterface) {
                $config = $this->processConfigForProvider($provider);
                $provider->register($builder, $config);
                continue;
            }

            $provider->register($builder);
        }
    }

    private function processConfigForProvider(
        ConfigObjectProviderInterface $provider,
    ): ConfigNodeInterface
    {
        $config = $provider->getDefaultConfigurationObject();
        /** @var array<Closure> $availableConfigs */
        $availableConfigs = $this
            ->configNodeFinder
            ->find(
                $provider->getConfigNode(),
            );

        foreach ($availableConfigs as $override) {
            $config = $override($config);
        }

        return $config;
    }

    private function buildServiceGraph(
        ContainerBuilder $builder
    ): ServiceGraph
    {
        $graph = new ServiceGraph();

        foreach ($builder->getDefinitions() as $definition) {
            $graph->add($definition);
        }

        foreach ($builder->getAliases() as $serviceId => $alias) {
            $graph->alias($serviceId, $alias);
        }

        foreach ($builder->getBindings() as $serviceId => $binding) {
            $graph->alias($serviceId, $binding);
        }

        $extensions = $this->getSortedBuildExtensions();
        foreach ($extensions as $extensionsInPriority) {
            foreach ($extensionsInPriority as $extension) {
                $extension->onContainerBuild($graph);
            }
        }

        return $graph;
    }

    /**
     * @return array<int, array<CompilerExtensionInterface>>
     */
    private function getSortedBuildExtensions(): array
    {
        $map = [];

        foreach ($this->extensions as $extension) {
            $map[$extension->priority][] = $extension->extension;
        }

        return $map;
    }

    private function resolveConfigurations(
        ContainerBuilder $builder,
    ): void
    {
        $emptyConfigsReceived = false;
        while (!$emptyConfigsReceived) {
            $configs = $builder->popConfigurations();
            $emptyConfigsReceived = count($configs) === 0;
            foreach ($configs as $config) {
                $config($builder);
            }
        }
    }

    private function processNamespaceScans(
        ContainerBuilder $builder
    ): void
    {
        foreach ($builder->getNamespaceScans() as $namespaceScan) {
            $sourceLocator = new DirectoriesSourceLocator(
                $namespaceScan->paths,
                new BetterReflection()->astLocator()
            );

            $reflector = new DefaultReflector($sourceLocator);

            $classReflections = $reflector->reflectAllClasses();

            foreach ($classReflections as $classReflection) {
                $service = $builder->set(
                    $classReflection->getName()
                );

                foreach ($namespaceScan->tags as $tag) {
                    $service->withTag($tag);
                }

            }
        }
    }

}