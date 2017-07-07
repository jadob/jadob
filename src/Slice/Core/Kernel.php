<?php
namespace Slice\Core;

use Slice\Config\ConfigReader;
use Slice\Container\Container;
use Slice\Container\ContainerAwareInterface;
use Slice\Container\ContainerTrait;
use Slice\Debug\Handler\ExceptionHandler;

/**
 * Class Kernel
 * @package Slice\Core
 */
class Kernel implements ContainerAwareInterface
{

    use ContainerTrait;

    /**
     * Current framework version.
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * @var string
     */
    private $environment;

    /**
     * @var ConfigReader
     */
    private $configReader;

    /**
     * @var string
     */
    private $rootDir;

    /**
     * @var string
     */
    private $publicDir;

    /**
     * @var array
     */
    private $configuration;

    /**
     * Kernel constructor.
     * @param string $env
     * @param string $rootDir
     * @param string $publicDir
     * @throws \RuntimeException
     */
    public function __construct($env, $rootDir, $publicDir)
    {
        $this->rootDir = $rootDir;
        $this->publicDir = $publicDir;
        $this->environment = $env;

        $this->container = new Container();

        $this->configReader = new ConfigReader();
        $this->configReader
            ->setConfigDir($rootDir.'/config')
            ->setEnvironment($env)
            ->addPlaceholder('app.rootDir', $this->getRootDir())
            ->addPlaceholder('app.publicDir', $this->getPublicDir());


        $this->configuration = $this->configReader->parseApplicationConfiguration();
        $this->registerExceptionHandler();

    }

    /**
     * Sets framework exception and error handlers as default
     * @return $this
     */
    private function registerExceptionHandler()
    {
        $handler = new ExceptionHandler($this->environment);
        $handler
            ->registerErrorHandler()
            ->registerExceptionHandler();

        return $this;
    }

    public function registerDepedencies()
    {

    }

    /**
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        $dispatcher = new Dispatcher();
        $dispatcher->setContainer($this->container);

        return $dispatcher;
    }

    /**
     * @return string
     */
    private function getRootDir(): string
    {
        return $this->rootDir;
    }

    /**
     * @return string
     */
    private function getPublicDir(): string
    {
        return $this->publicDir;

    }
}