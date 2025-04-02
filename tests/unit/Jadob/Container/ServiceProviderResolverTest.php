<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Fixtures\CircularServiceProviders\BarServiceProvider;
use Jadob\Container\Fixtures\CircularServiceProviders\FooServiceProvider;
use Jadob\Container\Fixtures\ServiceProviders\ApiServiceProvider;
use Jadob\Container\Fixtures\ServiceProviders\AuthServiceProvider;
use Jadob\Container\Fixtures\ServiceProviders\DatabaseServiceProvider;
use Jadob\Container\Fixtures\ServiceProviders\HttpClientProvider;
use Jadob\Container\Fixtures\ServiceProviders\IOLoggerProvider;
use Jadob\Container\Fixtures\ServiceProviders\OAuth2Provider;
use Jadob\Container\Fixtures\ServiceProviders\TemplatingProvider;
use PHPUnit\Framework\TestCase;

class ServiceProviderResolverTest extends TestCase
{

    public function testResolvingWouldFailIfThereIsMissingParentProviderCreated(): void
    {

        $resolver = new ServiceProviderResolver();

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage(
            'Unable to resolve service providers "Jadob\Container\Fixtures\ServiceProviders\IOLoggerProvider" as there is no parent provider "Jadob\Container\Fixtures\ServiceProviders\HttpClientProvider" registered.'
        );
        $resolver->resolveServiceProvidersOrder([
            new IOLoggerProvider(),
        ]);
    }


    public function testParentServiceProvidersDoesNotNeedToBeRegisteredBeforeTheChildProvider(): void
    {
        $resolver = new ServiceProviderResolver();
        $result = $resolver->resolveServiceProvidersOrder([
            new OAuth2Provider(),
            new HttpClientProvider(),
        ]);

        self::assertSame(
            [
                HttpClientProvider::class,
                OAuth2Provider::class
            ],
            $result
        );
    }


    public function testCatchingCircularReference(): void
    {
        $resolver = new ServiceProviderResolver();

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Circular dependency found: %s->%s->%s',
                FooServiceProvider::class,
                BarServiceProvider::class,
                FooServiceProvider::class
            )
        );

        $resolver->resolveServiceProvidersOrder([
            new FooServiceProvider(),
            new BarServiceProvider(),
        ]);
    }

    public function testResolving()
    {
        $resolver = new ServiceProviderResolver();

        $result = $resolver->resolveServiceProvidersOrder([
            new AuthServiceProvider(),
            new ApiServiceProvider(),
            new DatabaseServiceProvider(),
            new HttpClientProvider(),
            new OAuth2Provider(),
            new IOLoggerProvider(),
            new TemplatingProvider(),
        ]);

        self::assertSame(
            [
                DatabaseServiceProvider::class,
                AuthServiceProvider::class,
                ApiServiceProvider::class,
                HttpClientProvider::class,
                OAuth2Provider::class,
                IOLoggerProvider::class,
                TemplatingProvider::class,
            ], $result
        );

    }
}