<?php
declare(strict_types=1);

namespace Jadob\Objectable\Fixtures;

use Jadob\Objectable\Annotation\Field;

class Food
{
    #[Field(name: "name")]
    public string $name;
}