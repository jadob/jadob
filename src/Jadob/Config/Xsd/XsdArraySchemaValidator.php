<?php

namespace Jadob\Config\Xsd;

class XsdArraySchemaValidator
{

    public function validate(array $data, string $xsdContent)
    {
        $xsd = new \SimpleXMLElement($xsdContent);
    }

}