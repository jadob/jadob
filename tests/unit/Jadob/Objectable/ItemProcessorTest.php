<?php


namespace Jadob\Objectable;

use Jadob\Objectable\Fixtures\Food;
use Jadob\Objectable\Fixtures\Ingredient;
use Jadob\Objectable\Fixtures\FoodTransformer;
use PHPUnit\Framework\TestCase;

class ItemProcessorTest extends TestCase
{

    public function testItemExtractionWithoutAdditionalParameters(): void
    {
        $processor = new ItemProcessor();

        $obj = new Food();
        $obj->name = 'Fish';

        $serialized = $processor->extractItemValues($obj);

        self::assertSame(['name' => 'Fish'], $serialized);
    }

    public function testItemTransformer(): void
    {
        $processor = new ItemProcessor(
            itemTransformers: [
                new FoodTransformer()
            ]
        );

        $obj = new Food();
        $obj->name = 'Burger';

        $serialized = $processor->extractItemValues(
            $obj,
            'RECIPE_BOOK'
        );

        self::assertSame(
            [
                'name' => 'BURGER',
            ],
            $serialized
        );

    }
}