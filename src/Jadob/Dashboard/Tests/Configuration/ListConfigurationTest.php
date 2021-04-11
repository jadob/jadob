<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Tests\Configuration;

use Jadob\Dashboard\Configuration\ListConfiguration;
use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Tests\Fixtures\Cat;
use PHPUnit\Framework\TestCase;

class ListConfigurationTest extends TestCase
{
    public function testPassingConfigurationWithoutListOfFieldsWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Missing "fields" key for "Jadob\Dashboard\Tests\Fixtures\Cat" object!');

        ListConfiguration::create(Cat::class, []);
    }

    public function testPassingConfigurationWithInvalidListOfFieldsWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Value for "fields" key for "Jadob\Dashboard\Tests\Fixtures\Cat" object must be an array!');

        ListConfiguration::create(Cat::class, ['fields' => false]);
    }

    public function testPassingConfigurationWithInvalidResultsPerPageWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Value for "results_per_page" key for "Jadob\Dashboard\Tests\Fixtures\Cat" object must be an int!');

        ListConfiguration::create(Cat::class, ['fields' => [], 'results_per_page' => 'none of them']);
    }

    /**
     * @throws ConfigurationException
     */
    public function testPassingConfigurationWithValidResultsPerPageWillCauseOverridingDefaultValue(): void
    {
        $config = ListConfiguration::create(Cat::class, ['fields' => [], 'results_per_page' => 9000]);

        self::assertSame(9000, $config->getResultsPerPage());
    }

    public function testPassingConfigurationWithInvalidOperationsWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Value for "operations" key for "Jadob\Dashboard\Tests\Fixtures\Cat" object must be an array!');

        ListConfiguration::create(Cat::class, ['fields' => [], 'operations' => false]);

    }

    public function testPassingConfigurationWithIntAsOperationNameWillCauseAnException(): void
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Key operations.1 for "Jadob\Dashboard\Tests\Fixtures\Cat" object is invalid and must be an string!');

        ListConfiguration::create(Cat::class, ['fields' => [], 'operations' => [
            1 => []
        ]]);

    }
}