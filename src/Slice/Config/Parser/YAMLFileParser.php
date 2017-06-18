<?php
namespace Slice\Config\Parser;

use Symfony\Component\Yaml\Yaml;

class YAMLFileParser implements ConfigParserInterface
{

    protected $placeholders = [];
    protected $configuration = [];

    public function parse($filename): array
    {
        return Yaml::parse(file_get_contents($filename));
    }

}