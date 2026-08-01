<?php

namespace Jadob\Contracts\DependencyInjection;

/**
 * @internal
 */
enum ReferenceType
{
    case Param;
    case Service;

}