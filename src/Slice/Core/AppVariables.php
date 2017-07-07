<?php
namespace Slice\Core;

use Slice\Core\Traits\PublicDirTrait;
use Slice\Core\Traits\RootDirTrait;

/**
 * Class AppVariables
 * @package Slice\Core
 * @deprecated
 */
class AppVariables
{
    use RootDirTrait;
    use PublicDirTrait;

    /**
     * @var Environment
     */
    public $environment;

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

}