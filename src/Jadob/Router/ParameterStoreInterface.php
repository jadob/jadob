<?php
declare(strict_types=1);

namespace Jadob\Router;


interface ParameterStoreInterface
{

    public function has(string $paramName): bool;

    public function get(string $paramName): string;
}