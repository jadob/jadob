<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Annotations\ServiceProvider;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\FilesystemCache;
use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class DoctrineAnnotationsProvider implements ServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getConfigNode()
    {
        return 'doctrine';
    }

    /**
     * @inheritDoc
     */
    public function register($config)
    {
        if(!isset($config['annotations'])) {
            throw new \RuntimeException('There is no "annotations" section in "doctrine" config node."');
        }

        $annotationsConfig = $config['annotations'];

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