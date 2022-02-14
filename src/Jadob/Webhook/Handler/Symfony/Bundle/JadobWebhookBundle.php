<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Symfony\Bundle;

use Jadob\Webhook\Handler\Symfony\Bundle\DependencyInjection\CompilerPass\RegisterWebhookProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JadobWebhookBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterWebhookProviderPass());
    }
}