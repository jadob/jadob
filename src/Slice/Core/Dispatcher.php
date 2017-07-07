<?php
namespace Slice\Core;

use Slice\Container\ContainerTrait;
use Slice\Core\HTTP\ResponseInterface;
use Slice\Core\Traits\PublicDirTrait;
use Slice\Core\Traits\RootDirTrait;

/**
 * Class Dispatcher
 * @package Slice\Core
 */
class Dispatcher
{

    use PublicDirTrait;
    use RootDirTrait;
    use ContainerTrait;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct()
    {

    }

    public function dispatch()
    {
//        $router = $this->getContainer()->get('router');


        return $this;
    }

    public function sendOutput() {

    }


}