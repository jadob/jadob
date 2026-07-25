<?php

namespace Jadob\Container\Compiler;

use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\Exception\CircularDependencyException;
use Jadob\Container\Compiler\Exception\MissingParentServiceProviderException;
use Jadob\Container\Compiler\Exception\MissingRequiredParameterException;
use Jadob\Container\Fixtures\CircularServiceProviders\BarServiceProvider;
use Jadob\Container\Fixtures\CircularServiceProviders\FooServiceProvider;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\ServiceProvider\EmailServiceProvider;
use Jadob\Container\Fixtures\ServiceProviders\AuthServiceProvider;
use Jadob\Container\Fixtures\ServiceProviders\DatabaseServiceProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('container')]
#[Group('container-compiler')]
final class ContainerCompilerTest extends TestCase
{
    private ContainerCompiler $compiler;

    protected function setUp(): void
    {
        $this->compiler = new ContainerCompiler();
    }

    public function testCompilerWillBeDetectServiceProviderCircularDependency(): void
    {
        $builder = new ContainerBuilder();

        $builder->registerServiceProvider(new FooServiceProvider());
        $builder->registerServiceProvider(new BarServiceProvider());

        $this->expectException(CircularDependencyException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Circular dependency found: %s->%s->%s',
                FooServiceProvider::class,
                BarServiceProvider::class,
                FooServiceProvider::class
            )
        );

        $this
            ->compiler
            ->compile(
                $builder
            );

    }

    public function testCompilerWillFailOnMissingParentProvider(): void
    {
        $builder = new ContainerBuilder();

        $builder->registerServiceProvider(new AuthServiceProvider());

        $this->expectException(MissingParentServiceProviderException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Service provider "%s" requires provider "%s" to be registered but it was not found in container config.',
                AuthServiceProvider::class,
                DatabaseServiceProvider::class,
            )
        );

        $this
            ->compiler
            ->compile(
                $builder
            );

    }


//    public function testCompilerWillFailWhenServiceProviderWillRequestAMissingParameterWithoutFallback(): void
//    {
//        $builder = new ContainerBuilder();
//        $builder->registerServiceProvider(
//            new EmailServiceProvider()
//        );
//
//        $this->expectException(MissingRequiredParameterException::class);
//
//        $this
//            ->compiler
//            ->compile(
//                $builder,
//                []
//            );
//
//    }
}