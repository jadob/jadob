<?php

namespace Slice\SchemaManager\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\SchemaManager\SchemaManager;

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