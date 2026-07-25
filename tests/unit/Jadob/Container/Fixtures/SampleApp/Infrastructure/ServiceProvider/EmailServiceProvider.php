<?php

namespace Jadob\Container\Fixtures\SampleApp\Infrastructure\ServiceProvider;

use Jadob\Container\Fixtures\SampleApp\Application\Service\UserNotificationServiceInterface;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Email\UserMailerService;
use Jadob\Contracts\DependencyInjection\ConfigNode;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class EmailServiceProvider implements ServiceProviderInterface
{
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNode $config = null
    ): void
    {
        $builder->requireParameter('smtp_username');
        $builder->requireParameter('smtp_password');
        $builder->requireParameter('smtp_host');
        $builder->requireParameter('smtp_port');

        $builder->set(UserMailerService::class)
            ->withArg('smtpPort', Reference::param('smtp_port'))
            ->withArg('smtpHost', Reference::param('smtp_host'))
            ->withArg('smtpUser', Reference::param('smtp_username'))
            ->withArg('smtpPassword', Reference::param('smtp_password'));

        $builder->bind(
            UserNotificationServiceInterface::class,
            UserMailerService::class
        );
    }

    public function getConfigNode(): ?string
    {
        return null;
    }
}