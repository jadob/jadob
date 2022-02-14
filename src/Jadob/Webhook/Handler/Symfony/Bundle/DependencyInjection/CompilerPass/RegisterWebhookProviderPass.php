<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Symfony\Bundle\DependencyInjection\CompilerPass;

use Jadob\Webhook\Handler\Service\ProviderRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterWebhookProviderPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ProviderRegistry::class)) {
            return;
        }

        $definition = $container->findDefinition(ProviderRegistry::class);
        $taggedServices = $container->findTaggedServiceIds('jadob.webhook_handler');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addProvider', [new Reference($id)]);
        }
    }
}