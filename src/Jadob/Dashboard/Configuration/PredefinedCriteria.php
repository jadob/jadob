<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;

class PredefinedCriteria
{
    public static function create(string $name, array $config): self
    {
        $propsToCheck = ['method', 'label'];

        foreach ($propsToCheck as $propToCheck) {
            if (!array_key_exists($propToCheck,$config)) {
                throw new ConfigurationException(sprintf('Missing "%s" key in "%s" criteria!', $propToCheck, $name));
            }

            if (!is_string($config[$propToCheck])) {
                throw new ConfigurationException(sprintf('Value passed to "%s" key in "%s" criteria is not a string!', $propToCheck, $name));
            }
        }
    }
}