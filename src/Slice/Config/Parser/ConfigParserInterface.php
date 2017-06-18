<?php

namespace Slice\Config\Parser;


/**
 * Interface ConfigParserInterface
 * @package Slice\Config\Type
 */
interface ConfigParserInterface
{
    /**
     * Parses a configuration file.
     * @param string $filename
     * @return array
     */
    public function parse($filename);

}