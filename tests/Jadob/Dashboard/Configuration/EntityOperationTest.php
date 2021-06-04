<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;
use PHPUnit\Framework\TestCase;

class EntityOperationTest extends TestCase
{

    public function testPassingConfigurationWithMissingOperationLabelWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('There is no "label" key for "remove" operation!');

        EntityOperation::fromArray('remove', []);
    }

    public function testPassingConfigurationWithInvalidOperationLabelWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('"label" value for "update" operation must be an string!');

        EntityOperation::fromArray('update', [
            'label' => 1
        ]);

    }
}