<?php

declare(strict_types=1);

namespace Jadob\Container\Exception;

use LogicException;
use Psr\Container\ContainerExceptionInterface;

class ContainerLogicException extends LogicException implements ContainerExceptionInterface
{

}