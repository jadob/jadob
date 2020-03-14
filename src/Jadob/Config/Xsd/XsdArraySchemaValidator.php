<?php

namespace Jadob\Config\Xsd;

class XsdArraySchemaValidator
{

    public function validate(array $data, string $xsdContent): void
    {
        $xsd = new \SimpleXMLElement($xsdContent);
    }

}