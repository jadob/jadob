<?php
declare(strict_types=1);

namespace Jadob\Runtime\Type;


use Jadob\Runtime\RuntimeInterface;

class GenericRuntime implements RuntimeInterface
{

    public function getTmpDir(): ?string
    {
        return null;
    }

    public function getVersion(): string
    {
        return php_uname('v');
    }
}