<?php
namespace Slice\Config;

use RuntimeException;
use Slice\Config\Parser\ConfigParserInterface;
use Slice\Config\Parser\INIFileParser;
use Slice\Config\Parser\YAMLFileParser;

class ParserFileFactory
{

    /**
     * @param $extension
     * @return ConfigParserInterface
     * @throws RuntimeException
     */
    public static function getParser($extension)
    {

        switch ($extension) {
            case 'yml':
                return new YAMLFileParser();

            case 'ini':
                return new INIFileParser();
        }

        throw new RuntimeException('Could not match any file parser for .'.$extension.' file.');
    }
}