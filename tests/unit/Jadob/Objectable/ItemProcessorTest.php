<?php


namespace Jadob\Objectable;


use Doctrine\Common\Annotations\AnnotationReader;
use PHPUnit\Framework\TestCase;

class ItemProcessorTest extends TestCase
{

    public function testItemExtractionWithDoctrineAnnotations()
    {
        $processor = new ItemProcessor(
            new AnnotationReader()
        );
    }
}