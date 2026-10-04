<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

/**
 * Requires two random things outside its original hierarchy.
 * @implements ServiceProviderInterface<ConfigNodeInterface>
 */
class IOLoggerProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function getParentServiceProviders(): array
    {
        return [
            HttpClientProvider::class,
            DatabaseServiceProvider::class,
        ];
    }

   public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
   {

   }
}