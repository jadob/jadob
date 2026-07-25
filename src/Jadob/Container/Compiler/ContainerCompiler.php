<?php

namespace Jadob\Container\Compiler;

use Jadob\BetterContainer\Contract\ServiceProviderInterface;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\Exception\CircularDependencyException;
use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use MJS\TopSort\CircularDependencyException as TopSortCircularDependencyException;
use MJS\TopSort\Implementations\StringSort;

final readonly class ContainerCompiler
{

    /**
     * @param ContainerBuilder $container
     * @param array $parameters
     * @return void
     */
    public function compile(
        ContainerBuilder $builder,
        array            $parameters = [],
    ): void
    {

        $serviceProviders = $builder
            ->getServiceProviders();

        $serviceProviderOrder = $this
            ->calculateServiceProviderRegisterOrder(
                $serviceProviders,
            );
    }

    /**
     * @param array<ServiceProviderInterface> $providers
     * @return array
     * @throws CircularDependencyException
     */
    private function calculateServiceProviderRegisterOrder(
        array $providers,
    ): array
    {
        try {
            $sorter = new StringSort();
            foreach ($providers as $provider) {
                $dependencies = [];
                if ($provider instanceof ParentServiceProviderInterface) {
                    $dependencies = $provider->getParentServiceProviders();
                }

                $sorter->add(get_class($provider), $dependencies);
            }

            return $sorter->sort();
        } catch (TopSortCircularDependencyException $exception) {
            throw new CircularDependencyException(
                $exception->getMessage()
            );
        }

    }

}