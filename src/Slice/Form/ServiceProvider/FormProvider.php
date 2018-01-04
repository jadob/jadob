<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 02.01.2018
 * Time: 22:22
 */

namespace Slice\Form\ServiceProvider;


use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Form\FormFactory;

class FormProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param Container $container
     * @param $config
     * @return mixed
     */
    public function register(Container $container, $config)
    {
        $container->add('form.factory', new FormFactory());
    }
}