<?php

namespace Jadob\Form\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Form\FormFactory;

/**
 * Class FormProvider
 * @package Jadob\Form\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FormProvider implements ServiceProviderInterface
{

    /**
     * @return null
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param Container $container
     * @param array|null $config
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {
        $container->add('form.factory', new FormFactory(
            $container->get('database'),
            $container->get('translator')
        ));
    }
}