<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Tests\Configuration;


use Jadob\Dashboard\Configuration\ManagedObject;
use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Tests\Fixtures\Cat;
use PHPUnit\Framework\TestCase;

class ManagedObjectTest extends TestCase
{

    public function testCreatingObjectFromArrayWillBreakWhenThereWillBeListConfigurationMissing()
    {
        self::expectException(ConfigurationException::class);
        self::expectDeprecationMessage('Missing "list" key for "Jadob\Dashboard\Tests\Fixtures\Cat" object.');

        ManagedObject::fromArray(Cat::class, []);
    }

    public function testCreatingObjectFromArrayWillBreakWhenThereWillBeListConfigurationInvalid()
    {
        self::expectException(ConfigurationException::class);
        self::expectDeprecationMessage('Key "list" for "Jadob\Dashboard\Tests\Fixtures\Cat" object is not an array');

        ManagedObject::fromArray(Cat::class, ['list' => false]);
    }

}