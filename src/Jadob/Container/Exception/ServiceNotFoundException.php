<?php

namespace Jadob\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ServiceNotFoundException
 *
 * @package Jadob\Container\Exception
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ServiceNotFoundException extends ContainerException implements NotFoundExceptionInterface
{

}