<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Tests\Configuration;

use Jadob\Dashboard\Configuration\PredefinedCriteria;
use Jadob\Dashboard\Exception\ConfigurationException;
use PHPUnit\Framework\TestCase;

class PredefinedCriteriaTest extends TestCase
{
    public function testCreatingFromArrayWithMissingMethodWillCauseAnException()
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Missing "method" key in "hello" criteria!');

        PredefinedCriteria::create('hello', []);
    }

    public function testCreatingFromArrayWithInvalidMethodWillCauseAnException()
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Value passed to "method" key in "hello" criteria is not a string!');

        PredefinedCriteria::create('hello', ['method' => false]);
    }

    public function testCreatingFromArrayWithMissingLabelWillCauseAnException()
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Missing "label" key in "hello2" criteria!');

        PredefinedCriteria::create('hello2', ['method' => 'doSomething']);
    }

    public function testCreatingFromArrayWithInvalidLabelWillCauseAnException()
    {
        self::expectException(ConfigurationException::class);
        self::expectExceptionMessage('Value passed to "label" key in "hello2" criteria is not a string!');

        PredefinedCriteria::create('hello2', ['method' => 'doSomething', 'label' => null]);
    }
}