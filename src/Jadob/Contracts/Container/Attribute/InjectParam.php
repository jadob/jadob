<?php
declare(strict_types=1);

namespace Jadob\Contracts\Container\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class InjectParam
{
    public function __construct(
        protected string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}