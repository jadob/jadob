<?php

namespace Jadob\SchemaManager\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\SchemaManager\SchemaManager;

class SchemaManagerProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return 'schema_manager';
    }

    /**
     * @param Container $container
     * @param $config
     * @return mixed
     */
    public function register(Container $container, $config)
    {
        $container->add('db.schema_manager', new SchemaManager($container->get('doctrine.dbal'), $config));
    }
}