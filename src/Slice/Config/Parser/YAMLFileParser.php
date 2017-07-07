<?php

namespace Slice\Config\Parser;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YAMLFileParser
 * @package Slice\Config\Parser
 */
class YAMLFileParser implements ConfigParserInterface
{
    /**
     * @param string $filename
     * @return array
     * @throws \Symfony\Component\Yaml\Exception\ParseException
     */
    public function parse($filename): array
    {
        return Yaml::parse(file_get_contents($filename));
    }
}