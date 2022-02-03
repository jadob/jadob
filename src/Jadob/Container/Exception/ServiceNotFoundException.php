<?php
declare(strict_types=1);

namespace Jadob\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ServiceNotFoundException
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ServiceNotFoundException extends ContainerException implements NotFoundExceptionInterface
{
}