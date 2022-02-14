<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Symfony\Bundle\DependencyInjection;

use Jadob\Webhook\Handler\Symfony\Bundle\DependencyInjection\CompilerPass\RegisterWebhookProviderPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class JadobWebhookExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../Resources/config'));
        $loader->load('services.yaml');
    }

}