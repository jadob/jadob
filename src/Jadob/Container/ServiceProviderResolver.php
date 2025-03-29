<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use MJS\TopSort\CircularDependencyException;
use MJS\TopSort\ElementNotFoundException;
use MJS\TopSort\Implementations\StringSort;

class ServiceProviderResolver
{
    /**
     * @param list<ServiceProviderInterface> $serviceProviders
     * @return array
     * @throws ContainerLogicException
     */
    public function resolveServiceProvidersOrder(array $serviceProviders): array
    {
        try {
            $sorter = new StringSort();
            foreach ($serviceProviders as $serviceProvider) {
                /** @var class-string[] $dependencies */
                $dependencies = [];
                if ($serviceProvider instanceof ParentServiceProviderInterface) {
                    $dependencies = $serviceProvider->getParentServiceProviders();
                }

                $sorter->add(get_class($serviceProvider), $dependencies);
            }

            return $sorter->sort();
        } catch (ElementNotFoundException $exception) {
            throw new ContainerLogicException(
                sprintf(
                    'Unable to resolve service providers "%s" as there is no parent provider "%s" registered.',
                    $exception->getSource(), $exception->getTarget()
                )
            );
        } catch (CircularDependencyException $exception) {
            throw new ContainerLogicException(
                $exception->getMessage()
            );
        }
    }
}