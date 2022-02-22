<?php
declare(strict_types=1);

namespace Jadob\Objectable\Fixtures;


use Jadob\Objectable\Annotation\Field;

class Food
{

    #[Field(name: "name", order: 1)]
    public string $name;
}