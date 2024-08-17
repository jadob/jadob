<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Annotations\ServiceProvider;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\Reader;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

class DoctrineAnnotationsProvider implements ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function register($config)
    {
        AnnotationRegistry::registerLoader('class_exists');

        $factory = static function(): Reader {
            return new AnnotationReader();
        };

        return [
            'doctrine.annotations.reader' => $factory
        ];
    }

    /**
     * @inheritDoc
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}