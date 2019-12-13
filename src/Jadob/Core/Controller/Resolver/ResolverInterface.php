<?php

namespace Jadob\Core\Controller;


/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ResolverInterface
{
    public function resolve(array $parameters = []);

}