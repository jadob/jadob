<?php
declare(strict_types=1);

namespace Jadob;

use LogicException;
use function file_get_contents;
use function json_decode;
use function sprintf;
use const JSON_THROW_ON_ERROR;

class FixtureHelper
{
    /**
     * @throws \JsonException
     * @return mixed[]
     */
    public static function getJson(string $filename): array
    {
        $file = file_get_contents(
            sprintf('%s/%s.json', __DIR__ . '/../../fixtures', $filename)
        );

        if ($file === false) {
            throw new LogicException(
                sprintf(
                    'Unable to read json file "%s"',
                    $filename
                )
            );
        }

        $json = json_decode(
            $file,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        if (!is_array($json)) {
            throw new LogicException(
                sprintf(
                    'The file "%s" should contain JSON content that can be decoded to an array.',
                    $filename
                )
            );
        }

        return $json;
    }
}