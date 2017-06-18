<?php
namespace Slice\Core;

use Slice\Core\Traits\PublicDirTrait;
use Slice\Core\Traits\RootDirTrait;

/**
 * Class AppVariables
 * @package Slice\Core
 */
class AppVariables
{
    use RootDirTrait;
    use PublicDirTrait;

    /**
     * @var Environment
     */
    public $environment;
    public $route;
    public $request;

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param mixed $environment
     * @return AppVariables
     */
    public function setEnvironment(Environment $environment): AppVariables
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     * @return AppVariables
     */
    public function setRoute($route): AppVariables
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     * @return AppVariables
     */
    public function setRequest($request): AppVariables
    {
        $this->request = $request;
        return $this;
    }



}