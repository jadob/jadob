<?php
declare(strict_types=1);

namespace Jadob;

use function json_decode;
use function file_get_contents;
use function sprintf;
use const JSON_THROW_ON_ERROR;

class FixtureHelper
{
    public static function getJson(string $filename): array
    {
        return json_decode(
            file_get_contents(
                sprintf('%s/%s.json', __DIR__ . '/../../fixtures', $filename)
            ),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }

}