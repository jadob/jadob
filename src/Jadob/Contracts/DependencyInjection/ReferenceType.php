<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

/**
 * @internal
 */
enum ReferenceType
{
    case Param;
    case Service;
    case TaggedServices;
    case Literal;
}