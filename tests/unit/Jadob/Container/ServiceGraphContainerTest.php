<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\ContainerCompiler;
use Jadob\Container\Config\InMemoryConfigNodeFinder;
use Jadob\Container\Exception\ParameterNotFoundException;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Email\UserMailerService;
use Jadob\Contracts\DependencyInjection\Reference;
use PHPUnit\Framework\TestCase;

class ServiceGraphContainerTest extends TestCase
{


    public function testInstantiatingClassWithParameterRefs(): void
    {
        $builder = new ContainerBuilder();

        $builder
            ->set(UserMailerService::class)
            ->withArgument('smtpHost', Reference::param('smtp_host'))
            ->withArgument('smtpPort', Reference::param('smtp_port'))
            ->withArgument('smtpUser', Reference::param('smtp_user'))
            ->withArgument('smtpPass', Reference::param('smtp_pass'));

        $builder->addFallbackParameter('smtp_host', 'test');
        $builder->addFallbackParameter('smtp_port', 1);
        $builder->addFallbackParameter('smtp_user', 'test');
        $builder->addFallbackParameter('smtp_pass', 'test');

        $compiler = new ContainerCompiler(new InMemoryConfigNodeFinder([]));

        $container = new ServiceGraphContainer($compiler->compile($builder));

        self::assertInstanceOf(UserMailerService::class, $container->get(UserMailerService::class));
    }

    public function testInstantiatingClassWithMissingParameterRefs(): void
    {
        $builder = new ContainerBuilder();

        $builder
            ->set(UserMailerService::class)
            ->withArgument('smtpHost', Reference::param('smtp_host'))
            ->withArgument('smtpPort', Reference::param('smtp_port'))
            ->withArgument('smtpUser', Reference::param('smtp_user'))
            ->withArgument('smtpPass', Reference::param('smtp_pass'));


        $compiler = new ContainerCompiler(new InMemoryConfigNodeFinder([]));

        $container = new ServiceGraphContainer($compiler->compile($builder));

        $this->expectException(ParameterNotFoundException::class);
        $this->expectExceptionMessage('Parameter "smtp_host" was requested but was not found in service graph.');
        $container->get(UserMailerService::class);

    }
}