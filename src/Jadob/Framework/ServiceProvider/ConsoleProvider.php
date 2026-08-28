<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\Kernel;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * @see    https://symfony.com/doc/current/components/console.html
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class ConsoleProvider implements ServiceProviderInterface
{
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        if (strtolower(PHP_SAPI) === 'cli') {
            $builder->set(HelperSet::class);

            $builder->set(Application::class)
                ->withFactory(
                    function (HelperSet $helperSet) {
                        $application = new Application('Jadob', Kernel::VERSION);
                        $application->setHelperSet($helperSet);

                        return $application;
                    }
                );
        }
    }
}