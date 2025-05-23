<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\Kernel;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Adds symfony/console functionality to framework.
 *
 * @see     https://symfony.com/doc/3.4/components/console.html
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ConsoleProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): ?string
    {
        return null;
    }

    /**
     * @param ContainerInterface $container
     * @param object|array|null $config
     *
     * @return array
     *
     */
    public function register(ContainerInterface $container, null|object|array $config = null): array
    {
        /**
         * We should not rely on PHP_SAPI here
         */
        if (strtolower(PHP_SAPI) === 'cli') {
            return [
                Application::class => [
                    'factory' => function (HelperSet $helperSet) {
                        $application = new Application('Jadob', Kernel::VERSION);
                        $application->setHelperSet($helperSet);

                        return $application;
                    }
                ],
                HelperSet::class => [
                    'factory' => function () {
                        return new HelperSet();
                    }
                ]
            ];
        }

        return [];
    }

}