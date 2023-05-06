<?php
declare(strict_types=1);

namespace Jadob\Container;

use Closure;
use function is_array;
use Jadob\Container\Event\ContainerBuildStartedEvent;
use Jadob\Container\Event\ProviderRegisteredEvent;
use Jadob\Container\Event\ProviderRegistrationStartedEvent;
use Jadob\Container\Event\ServiceAddedEvent;
use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class ContainerBuilder
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ContainerBuilder
{
    /**
     * @var array
     */
    protected $services = [];


    /**
     * @var array<string|class-string, Definition>
     */
    protected array $definitions = [];

    /**
     * @var ServiceProviderInterface[]
     */
    protected $instantiatedProviders = [];

    /**
     * @var string[]
     */
    protected $serviceProviders = [];

    /**
     * @var ContainerEventListener
     */
    protected $eventListener;

    /**
     * ContainerBuilder constructor.
     * @param ContainerEventListener|null $eventListener
     */
    public function __construct(?ContainerEventListener $eventListener = null)
    {
        $this->eventListener = $eventListener;
    }


    protected function emit(object $event): void
    {
        if ($this->eventListener !== null) {
            $this->eventListener->emit($event);
        }
    }

    /**
     * @param string $serviceName
     * @param mixed $definition
     * @return $this
     */
    public function add($serviceName, $definition): self
    {
        $this->emit(new ServiceAddedEvent($serviceName));

        if($definition instanceof Definition) {
            $this->definitions[$serviceName] = $definition;
            return $this;
        }

        $this->definitions[$serviceName] = new Definition($definition);
        return $this;
    }

    /**
     * @param array $config
     * @return Container
     * @throws ContainerException
     * @throws ContainerBuildException
     * @throws Exception\ServiceNotFoundException
     */
    public function build(array $config = []): Container
    {
        $this->emit(new ContainerBuildStartedEvent());
        foreach ($this->serviceProviders as $serviceProvider) {

            //prevent registration duplication
            if (isset($this->instantiatedProviders[$serviceProvider])) {
                continue;
            }

            $this->emit(new ProviderRegistrationStartedEvent($serviceProvider));
            $provider = $this->instantiateProvider($serviceProvider);

            /**
             * If current provider relies on others, it possible to define them by implementing an interface to them.
             * Then, parent classes will be registered before the current one
             */
            if ($provider instanceof ParentProviderInterface) {
                foreach ($provider->getParentProviders() as $parentProviderFqcn) {

                    //Use existing provider if exists
                    if (isset($this->instantiatedProviders[$parentProviderFqcn])) {
                        $parentProvider = $this->instantiatedProviders[$parentProviderFqcn];
                    } else {
                        $parentProvider = $this->instantiateProvider($parentProviderFqcn);
                    }

                    $this->registerProvider($parentProvider, $config);
                }
            }

            $this->registerProvider($provider, $config);
            $this->emit(new ProviderRegisteredEvent($serviceProvider));
        }

        $container = new Container($this->services, $this->factories);

        foreach ($this->instantiatedProviders as $provider) {
            $configNodeKey = $provider->getConfigNode();
            $configNode = $this->getConfigNode($config, $configNodeKey);
            $provider->onContainerBuild($container, $configNode);
        }

        return $container;
    }

    /**
     * @param array $config
     * @param string $configNodeKey
     * @return array|null
     *
     * @throws ContainerBuildException
     * @throws ContainerException
     */
    protected function getConfigNode(array $config, $configNodeKey): ?array
    {
        //TODO: Refactor
        if ($configNodeKey !== null && !isset($config[$configNodeKey])) {
            throw new ContainerException('Could not find config node named "' . $configNodeKey . '"');
        }

        //if provider does not needs any config, we can pass null then
        if ($configNodeKey === null) {
            return null;
        }

        $output = $config[$configNodeKey];

        if (!is_array($output)) {
            throw new ContainerBuildException('Invalid config passed to config node "' . $configNodeKey . '". Expected array, got ' . gettype($output));
        }

        return $output;
    }

    /**
     * @param ServiceProviderInterface[]|string[] $serviceProviders
     * @return ContainerBuilder
     */
    public function setServiceProviders(array $serviceProviders): ContainerBuilder
    {
        $this->serviceProviders = $serviceProviders;
        return $this;
    }

    /**
     * @param string $providerClass
     * @return ServiceProviderInterface
     * @throws ContainerBuildException
     */
    private function instantiateProvider(string $providerClass): ServiceProviderInterface
    {
        $provider = new $providerClass();

        if (!($provider instanceof ServiceProviderInterface)) {
            throw new ContainerBuildException('Class ' . $providerClass . ' cannot be used as an service provider');
        }

        $this->instantiatedProviders[$providerClass] = $provider;

        return $provider;
    }

    private function registerProvider(ServiceProviderInterface $provider, array $config = []): void
    {
        $configNodeKey = $provider->getConfigNode();
        $configNode = $this->getConfigNode($config, $configNodeKey);

        $results = $provider->register($configNode);

        if (is_array($results)) {
            foreach ($results as $serviceKey => $service) {
                $this->add($serviceKey, $service);
            }
        }
    }
}