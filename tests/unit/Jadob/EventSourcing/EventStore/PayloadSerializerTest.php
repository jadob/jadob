<?php
declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore;

use Jadob\EventStore\PayloadSerializer;
use Monolog\Test\TestCase;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class PayloadSerializerTest extends TestCase
{
    public function testSerialization(): void
    {
        $serializer = new PayloadSerializer();

        $payload = ['foo' => 'bar', 'iron' => 'man'];
        $result = $serializer->serialize($payload);

        $this->assertSame(json_decode($result, true), $payload);
    }

    public function testDeserialization(): void
    {
        $serializer = new PayloadSerializer();

        $payload = ['foo' => 'bar', 'iron' => 'man'];
        $result = $serializer->deserialize('{"foo":"bar","iron":"man"}');

        $this->assertSame($result, $payload);
    }
}