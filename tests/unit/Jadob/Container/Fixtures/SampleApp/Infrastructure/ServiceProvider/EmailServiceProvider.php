<?php

namespace Jadob\Container\Fixtures\SampleApp\Infrastructure\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Container\Fixtures\SampleApp\Application\Service\UserNotificationServiceInterface;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Email\UserMailerService;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final readonly class EmailServiceProvider implements ServiceProviderInterface
{
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface $config = null
    ): void
    {
        $builder->requireParameter('smtp_username');
        $builder->requireParameter('smtp_password');
        $builder->requireParameter('smtp_host');
        $builder->requireParameter('smtp_port');

        $builder->set(UserMailerService::class)
            ->withArgument('smtpPort', Reference::param('smtp_port'))
            ->withArgument('smtpHost', Reference::param('smtp_host'))
            ->withArgument('smtpUser', Reference::param('smtp_username'))
            ->withArgument('smtpPassword', Reference::param('smtp_password'));

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