<?php

namespace Jadob\Container\Compiler;

use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\Exception\CircularDependencyException;
use Jadob\Container\Compiler\Exception\MissingRequiredParameterException;
use Jadob\Container\Fixtures\CircularServiceProviders\BarServiceProvider;
use Jadob\Container\Fixtures\CircularServiceProviders\FooServiceProvider;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\ServiceProvider\EmailServiceProvider;
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