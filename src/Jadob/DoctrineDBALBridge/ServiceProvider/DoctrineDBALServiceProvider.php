<?php

namespace Jadob\DoctrineDBALBridge\ServiceProvider;

use Jadob\Bridge\Doctrine\DBAL\ServiceProvider\DoctrineDBALProvider;


/**
 * @deprecated
 * Class DoctrineDBALServiceProvider
 * @package Jadob\DoctrineDBALBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DoctrineDBALServiceProvider extends DoctrineDBALProvider {

    public function __construct()
    {
        @trigger_error(\get_class($this).' is deprecated and will be removed soon. Please change DBAL provider to '. DoctrineDBALProvider::class. ' in your bootstrap file.', E_USER_DEPRECATED);
    }
}