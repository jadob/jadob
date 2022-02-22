<?php


namespace Jadob\Objectable;


use Doctrine\Common\Annotations\AnnotationReader;
use Jadob\Objectable\Fixtures\Food;
use PHPUnit\Framework\TestCase;

class ItemProcessorTest extends TestCase
{

    public function testItemExtraction()
    {
        $processor = new ItemProcessor(
            new AnnotationReader()
        );

        $obj = new Food();
        $obj->name = 'Fish';

        $serialized = $processor->extractItemValues($obj);

        self::assertSame(['name' => 'Fish'], $serialized);
    }
}