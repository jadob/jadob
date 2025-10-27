<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Fixtures\Cat;
use PHPUnit\Framework\TestCase;

class ManagedObjectTest extends TestCase
{

    public function testCreatingObjectFromArrayWillBreakWhenThereWillBeListConfigurationMissing()
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Missing "list" key for "Jadob\Dashboard\Fixtures\Cat" object.');

        ManagedObject::fromArray(Cat::class, []);
    }

    public function testCreatingObjectFromArrayWillBreakWhenThereWillBeListConfigurationInvalid()
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Key "list" for "Jadob\Dashboard\Fixtures\Cat" object is not an array');

        ManagedObject::fromArray(Cat::class, ['list' => false]);
    }

}