<?php

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\Fixtures\FastFoodRestaurantInterface;
use Jadob\Container\Fixtures\FoodTruck;
use Jadob\Container\Fixtures\KebabShop;
use Jadob\Container\Fixtures\ShopDomain\DbProductRepository;
use Jadob\Container\Fixtures\ShopDomain\ProductRepositoryInterface;
use Jadob\Container\Fixtures\ShopDomain\ProductService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


/**
 * Watch out:
 * - sprintf() in expectExceptionMessage() is used to make test cases a little bit more readable.
 */
class ContainerTest extends TestCase
{
    public function testAccessingCreatedInstanceViaNonClassStringServiceId(): void
    {
        $container = new Container();
        $instance = new KebabShop();
        $container->add('kebab_shop', $instance);

        self::assertSame($instance, $container->get('kebab_shop'));
    }

    public function testAccessingSharedServiceMultipleTimesWillAlwaysReturnTheSameInstance(): void
    {
        $container = new Container();
        $instance = new KebabShop();
        $container->add('kebab_shop', $instance);

        self::assertSame($instance, $container->get('kebab_shop'));
        self::assertSame($instance, $container->get('kebab_shop'));
        self::assertSame($instance, $container->get('kebab_shop'));
    }

    public function testAccessingSharedServiceViaServiceIdAndClassNameWillReturnTheSameInstance()
    {
        $container = new Container();
        $instance = new KebabShop();
        $container->add('kebab_shop', $instance);

        self::assertSame($instance, $container->get('kebab_shop'));
        self::assertSame($instance, $container->get(KebabShop::class));
    }

    public function testAccessingServiceViaItsInterfaceWillReturnAnInstanceWhenOnlyOneImplementationIsAvailable(): void
    {
        $container = new Container();
        $instance = new KebabShop();
        $container->add('kebab_shop', $instance);

        self::assertSame($container->get(FastFoodRestaurantInterface::class), $instance);
    }

    public function testAccessingServiceViaItsInterfaceWillReturnAnErrorWhenMultipleImplementationsAvailable(): void
    {
        $container = new Container();
        $container->add('kebab_shop', new KebabShop());
        $container->add('food_truck', new FoodTruck());

        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage(
            'Interface "Jadob\Container\Fixtures\FastFoodRestaurantInterface" have multiple implementations, cannot determine which one to use.'
        );
        $container->get(FastFoodRestaurantInterface::class);
    }

    public function testAccessingServiceViaItsInterfaceWillReturnAnErrorWhenNoneImplementationsAvailable(): void
    {
        $container = new Container();

        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage(
            'Interface "Jadob\Container\Fixtures\FastFoodRestaurantInterface" does not have any implementations provided in container'
        );
        $container->get(FastFoodRestaurantInterface::class);
    }

    public function testAccessingNonExistentServiceViaPlainIdWillResultInAnError(): void
    {
        $container = new Container();

        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage(
            'Service "half-life3" not found in container.'
        );
        $container->get('half-life3');
    }


    public function testAutowiringWillFailWhenThereAreMissingDependencies(): void
    {
        $container = Container::fromArrayConfiguration([
            'services' => [
                ProductService::class => []
            ]
        ]);

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
        $container = Container::fromArrayConfiguration([
            'services' => [
                ProductService::class => [],
                DbProductRepository::class => new DbProductRepository()
            ]
        ]);

        self::assertInstanceOf(ProductService::class, $container->get(ProductService::class));
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ContainerException
     */
    public function testFactoryAddedDirectlyViaAddWillNotBeWrappedAgain(): void
    {
        $container = new Container();
        $container->add(KebabShop::class, static fn() => new KebabShop());

        self::assertInstanceOf(
            KebabShop::class,
            $container->get(KebabShop::class)
        );
    }

    public function testAddingServiceWithArrayDefinitionWithJustClassDefined()
    {
        $container = new Container();
        $container->add(KebabShop::class, [
            'class' => KebabShop::class
        ]);

        self::assertInstanceOf(
            KebabShop::class,
            $container->get(KebabShop::class)
        );
    }

    public function testAddingServiceWithArrayDefinitionWithFactoryDefined()
    {
        $container = new Container();
        $container->add(KebabShop::class, [
            'factory' => static fn() => new KebabShop()
        ]);

        self::assertInstanceOf(
            KebabShop::class,
            $container->get(KebabShop::class)
        );
    }


    public function testAddingServiceWithArrayDefinitionWithoutExplicitClassName()
    {
        $container = new Container();
        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage(
            'Unable to add service "kebab_shop" to container, as it has neither className or factory return hint defined.'
        );

        $container->add('kebab_shop', [
            'factory' => static fn() => new KebabShop()
        ]);
    }

    public function testAddingServiceWithNoClassNameHintWillFail()
    {
        $container = new Container();

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage('Unable to add service "kebab_shop" to container, as it has neither className or factory return hint defined.');

        $container->add('kebab_shop', static fn() => new KebabShop());
    }


    public function testAddingFactoryWithInterfaceAsAServiceId()
    {
        $container = new Container();

        $container->add(FastFoodRestaurantInterface::class, function () {
            return new KebabShop();
        });

        self::assertTrue($container->has(FastFoodRestaurantInterface::class));
    }
}