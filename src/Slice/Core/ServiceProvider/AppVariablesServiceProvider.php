<?php

namespace Slice\Core\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Core\AppVariables;

/**
 * Class AppVariablesServiceProvider
 * @package Slice\Core\ServiceProvider
 * @deprecated
 */
class AppVariablesServiceProvider implements ServiceProviderInterface
{

    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function register(Container $container, array $configuration)
    {
        $appVariables = new AppVariables();
        $appVariables
            ->setRootDir($this->params['rootDir'])
            ->setPublicDir($this->params['publicDir'])
            ->setEnvironment($this->params['environment']);

        $container->add('app', $appVariables);
    }
}