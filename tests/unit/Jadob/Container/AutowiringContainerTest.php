<?php
declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\Fixtures\FastFoodRestaurantInterface;
use Jadob\Container\Fixtures\KebabShop;
use Jadob\Container\Fixtures\ShopDomain\DbProductRepository;
use Jadob\Container\Fixtures\ShopDomain\ProductRepositoryInterface;
use Jadob\Container\Fixtures\ShopDomain\ProductService;
use Jadob\Contracts\DependencyInjection\ConstructorInjectionExtensionInterface;
use PHPUnit\Framework\TestCase;

class AutowiringContainerTest extends TestCase
{
    /**
     * @param list<ConstructorInjectionExtensionInterface> $extensions
     * @param list<string> $autowirableNamespacePrefixes
     */
    private function createAutowiringContainer(
        Container $inner = new Container(),
        array $extensions = [],
        array $autowirableNamespacePrefixes = ['Jadob\\'],
    ): AutowiringContainer {
        return new AutowiringContainer($inner, $extensions, $autowirableNamespacePrefixes);
    }

    public function testAutowiringWillFailWhenThereAreMissingDependencies(): void
    {
        $container = $this->createAutowiringContainer(Container::fromArrayConfiguration([
            'services' => [
                ProductService::class => [],
            ],
        ]));

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Unable to autowire service "Jadob\Container\Fixtures\ShopDomain\ProductService" (Resolving chain: %s -> %s)',
                ProductService::class,
                ProductRepositoryInterface::class
            )
        );
        $container->get(ProductService::class);
    }

    public function testAutowiringWillSuccessWhenThereAreRequiredDependenciesRegistered(): void
    {
        $container = $this->createAutowiringContainer(Container::fromArrayConfiguration([
            'services' => [
                ProductService::class => [],
                DbProductRepository::class => new DbProductRepository(),
            ],
        ]));

        self::assertInstanceOf(ProductService::class, $container->get(ProductService::class));
    }

    public function testClassOnlyRegisteredServiceResolvesViaAutowiring(): void
    {
        $container = $this->createAutowiringContainer();
        $container->getInner()->add(KebabShop::class, [
            'class' => KebabShop::class,
        ]);

        self::assertInstanceOf(KebabShop::class, $container->get(KebabShop::class));
    }

    public function testClassOnlyRegisteredServiceViaInterfaceResolvesViaAutowiring(): void
    {
        $container = $this->createAutowiringContainer();
        $container->getInner()->add(FastFoodRestaurantInterface::class, [
            'class' => KebabShop::class,
        ]);

        self::assertSame(
            $container->get(FastFoodRestaurantInterface::class),
            $container->get(KebabShop::class)
        );
    }

    public function testUnregisteredClassCanBeAutowiredOnDemandWithinAllowedNamespace(): void
    {
        $container = $this->createAutowiringContainer();

        self::assertInstanceOf(KebabShop::class, $container->get(KebabShop::class));
    }

    public function testUnregisteredClassOutsideAllowedNamespaceCannotBeAutowiredOnDemand(): void
    {
        $container = $this->createAutowiringContainer(autowirableNamespacePrefixes: ['App\\']);

        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage(
            sprintf('Service "%s" not found in container.', KebabShop::class)
        );
        $container->get(KebabShop::class);
    }

    public function testHasReturnsFalseForClassOutsideAllowedNamespace(): void
    {
        $container = $this->createAutowiringContainer(autowirableNamespacePrefixes: ['App\\']);

        self::assertFalse($container->has(KebabShop::class));
    }

    public function testConstructorInjectionExtensionIsNotDoubleResolved(): void
    {
        $calls = 0;
        $extension = new class($calls) implements ConstructorInjectionExtensionInterface {
            public function __construct(private int &$calls)
            {
            }

            public function supportsConstructorInjectionFor(
                string $class,
                string $argumentName,
                string $argumentType,
                array $argumentAttributes,
            ): bool {
                return $argumentType === ProductRepositoryInterface::class;
            }

            public function injectConstructorArgument(
                string $class,
                string $argumentName,
                string $argumentType,
                array $argumentAttributes,
            ): object {
                $this->calls++;
                return new DbProductRepository();
            }
        };

        $inner = Container::fromArrayConfiguration([
            'services' => [
                ProductService::class => [],
            ],
        ]);

        $container = $this->createAutowiringContainer($inner, [$extension]);
        $container->get(ProductService::class);

        self::assertSame(1, $calls);
    }
}
