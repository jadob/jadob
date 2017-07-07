<?php

namespace Slice\Config;

use RuntimeException;
use Slice\Config\Parser\ConfigParserInterface;
use Slice\Config\Parser\INIFileParser;
use Slice\Config\Parser\YAMLFileParser;

/**
 * Class ParserFileFactory
 * @package Slice\Config
 * @author pizzaminded <github.com/pizzaminded>
 */
class ParserFileFactory
{

    /**
     * Returns a parser for configuration files.
     * @param $extension
     * @return ConfigParserInterface
     * @throws RuntimeException
     */
    public static function getParser($extension): ConfigParserInterface
    {

        switch ($extension) {
            case 'yml':
            case 'yaml':
                return new YAMLFileParser();

            case 'ini':
                return new INIFileParser();
        }

        throw new RuntimeException('Could not match any file parser for .'.$extension.' file.');
    }
}