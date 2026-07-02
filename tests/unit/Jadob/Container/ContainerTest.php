<?php
declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\Fixtures\ConnectionRegistryInterface;
use Jadob\Container\Fixtures\DoctrineLikeRegistry;
use Jadob\Container\Fixtures\FastFoodRestaurantInterface;
use Jadob\Container\Fixtures\FoodTruck;
use Jadob\Container\Fixtures\KebabShop;
use Jadob\Container\Fixtures\ManagerRegistryInterface;
use Jadob\Container\Fixtures\ServiceProviders\NonExistingConfigNodeServiceProvider;
use Jadob\Container\Fixtures\ShopDomain\DbProductRepository;
use Jadob\Container\Fixtures\ShopDomain\ProductRepositoryInterface;
use Jadob\Container\Fixtures\ShopDomain\ProductService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Watch out:
 * - sprintf() in expectExceptionMessage() is used to make test cases a little bit more readable.
 *
 *
 * @TODO: Things to test (and fix):
 * - PSR event dispatcher and contracts/event dispatcher
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

    public function testAccessingSharedServiceViaServiceIdAndClassNameWillReturnTheSameInstance(): void
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

    public function testClassOnlyDefinitionThrowsWhenResolvedByBaseContainer(): void
    {
        $container = new Container();
        $container->add(KebabShop::class, [
            'class' => KebabShop::class,
        ]);

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Service "%s" has no factory; register an explicit factory or use AutowiringContainer.',
                KebabShop::class
            )
        );
        $container->get(KebabShop::class);
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

    public function testAddingServiceWithArrayDefinitionWithFactoryDefined(): void
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


    public function testAddingServiceWithArrayDefinitionWithoutExplicitClassName(): void
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

    public function testAddingServiceWithNoClassNameHintWillFail(): void
    {
        $container = new Container();

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage('Unable to add service "kebab_shop" to container, as it has neither className or factory return hint defined.');

        $container->add('kebab_shop', static fn() => new KebabShop());
    }


    public function testAddingFactoryWithInterfaceAsAServiceId(): void
    {
        $container = new Container();

        $container->add(FastFoodRestaurantInterface::class, function () {
            return new KebabShop();
        });

        self::assertTrue($container->has(FastFoodRestaurantInterface::class));
    }

    public function testResolvingProviderWithNonExistingConfigNode(): void
    {
        $container = new Container();

        $container->registerServiceProvider(new NonExistingConfigNodeServiceProvider());

        $this->expectException(ContainerLogicException::class);
        $this->expectExceptionMessage('Service provider "Jadob\Container\Fixtures\ServiceProviders\NonExistingConfigNodeServiceProvider" requested for configuration node "yeti", which was not found.');
        $container->resolveServiceProviders([]);
    }

    public function testAccessingSharedFactoryServiceViaParentInterfaceReturnsSameInstance(): void
    {
        $container = new Container();
        $container->add(ManagerRegistryInterface::class, static function (): ManagerRegistryInterface {
            return new DoctrineLikeRegistry();
        });

        self::assertSame(
            $container->get(ManagerRegistryInterface::class),
            $container->get(ConnectionRegistryInterface::class)
        );
    }

    public function testAccessingSharedFactoryServiceViaInterfaceAndConcreteClassReturnsSameInstance(): void
    {
        $container = new Container();
        $container->add(KebabShop::class, static fn(): KebabShop => new KebabShop());

        self::assertSame(
            $container->get(FastFoodRestaurantInterface::class),
            $container->get(KebabShop::class)
        );
    }

    public function testAccessingSharedFactoryServiceViaServiceIdAndClassNameReturnsSameInstance(): void
    {
        $container = new Container();
        $container->add('kebab_shop', static fn(): KebabShop => new KebabShop());

        self::assertSame(
            $container->get('kebab_shop'),
            $container->get(KebabShop::class)
        );
    }

    public function testAliasResolvesToSameSharedInstance(): void
    {
        $container = new Container();
        $container->add(KebabShop::class, static fn(): KebabShop => new KebabShop());
        $container->alias('kebab_shop', KebabShop::class);

        self::assertTrue($container->has('kebab_shop'));
        self::assertSame(
            $container->get(KebabShop::class),
            $container->get('kebab_shop')
        );
    }

    public function testSetReplacesServiceAndInvalidatesCachedInstance(): void
    {
        $container = new Container();
        $container->add(KebabShop::class, static fn(): KebabShop => new KebabShop());
        $firstInstance = $container->get(KebabShop::class);

        $container->set(KebabShop::class, static fn(): KebabShop => new KebabShop());
        $secondInstance = $container->get(KebabShop::class);

        self::assertNotSame($firstInstance, $secondInstance);
    }

    public function testReRegisteringSameServiceIdDoesNotCreateDuplicateClassMapEntries(): void
    {
        $container = new Container();
        $container->add(KebabShop::class, static fn(): KebabShop => new KebabShop());
        $container->add(KebabShop::class, static fn(): KebabShop => new KebabShop());

        self::assertInstanceOf(KebabShop::class, $container->get(KebabShop::class));
        self::assertSame(
            $container->get(KebabShop::class),
            $container->get(FastFoodRestaurantInterface::class)
        );
    }
}
