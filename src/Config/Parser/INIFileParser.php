<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 13.06.2017
 * Time: 22:23
 */

namespace Slice\Config\Parser;


class INIFileParser implements ConfigParserInterface
{

    protected $replacePlaceholders = false;

    public function parse($filename)
    {
        return parse_ini_file($filename);
    }


    public function setReplacePlaceholders(bool $value): INIFileParser
    {
        $this->replacePlaceholders = $value;
        return $this;
    }
}