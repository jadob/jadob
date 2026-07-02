<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Psr\Container\ContainerInterface;

interface ExtendedContainerInterface extends ContainerInterface
{
    /**
     * @return list<object>
     */
    public function getTaggedServices(string $tag): array;
}
