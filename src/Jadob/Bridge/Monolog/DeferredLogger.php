<?php

declare(strict_types=1);

namespace Jadob\Bridge\Monolog;

use Monolog\Logger;

class DeferredLogger extends Logger
{

    protected $recordStack = [];


    /**
     * {@inheritDoc}
     */
    public function addRecord($level, $message, array $context = array())
    {
        //save timestamo
        //store it
    }

    public function close()
    {

        //probably parent::reset() should be called here
        //Format logs
        //send to handlers
        //close handlers
    }

    public function __destruct()
    {
        $this->close();
    }


}