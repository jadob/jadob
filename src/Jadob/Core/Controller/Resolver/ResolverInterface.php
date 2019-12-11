<?php

namespace Jadob\Core\Controller;


/**
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ResolverInterface
{
    public function resolve(array $parameters = []);

}