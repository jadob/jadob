<?php
namespace Slice\Core;

use RuntimeException;
use Slice\Config\ConfigReader;
use Slice\Container\Container;
use Slice\Container\ContainerAwareInterface;
use Slice\Container\ContainerTrait;
use Slice\Core\ServiceProvider\AppVariablesServiceProvider;
use Slice\Core\ServiceProvider\TopLevelDepedenciesServiceProvider;
use pizzaORM\ServiceProvider\pizzaORMServiceProvider;
use Slice\Debug\Handler\ExceptionHandler;
use Slice\Router\ServiceProvider\RouterServiceProvider;

class Kernel implements ContainerAwareInterface
{
//    use RootDirTrait;
//    use PublicDirTrait;
    use ContainerTrait;

    const VERSION = '0.0.0';

    protected $environment;
    protected $configReader;

    /**
     * @var array
     */
    protected $configuration = [];

    public function __construct($env, $rootDir, $publicDir)
    {
        $this->container = new Container();
        $appVariables = new AppVariables();
        $appVariables
            ->setRootDir($rootDir)
            ->setPublicDir($publicDir)
            ->setEnvironment(new Environment($env));

        $this->getContainer()->add('app',$appVariables);
                $this->configReader = new ConfigReader($this->getContainer()->get('app'));
    }

    private function getRootDir(): string
    {
        /** @var AppVariables $app */
        $app = $this->getContainer()->get('app');
        return $app->getRootDir();
    }

    private function getPublicDir(): string
    {
        /** @var AppVariables $app */
        $app = $this->getContainer()->get('app');
        return $app->getPublicDir();

    }

    public function registerExceptionHandler()
    {
        /** @var Environment $environment */
        $environment = $this->getContainer()->get('app')->getEnvironment();

        $handler = new ExceptionHandler($environment);
        $handler
            ->registerErrorHandler()
            ->registerExceptionHandler();


        return $this;
    }

    public function loadFullConfiguration(): Kernel
    {
        if ($this->getRootDir() === null) {
            throw new RuntimeException('Root directory is undefined, could not parse configuration');
        }

        $this->configuration = $this->configReader
            ->setConfigDir($this->getRootDir() . '/App/config')
            ->addPlaceholder('app.rootDir', $this->getRootDir())
            ->addPlaceholder('app.publicDir', $this->getPublicDir())
            ->parseApplicationConfiguration();

        return $this;
    }

    public function registerDepedencies(): Kernel
    {
        $this->container
            ->registerProvider(TopLevelDepedenciesServiceProvider::class)
            ->registerProvider(AppVariablesServiceProvider::class, [
                'rootDir' => $this->getRootDir(),
                'publicDir' => $this->getPublicDir(),
                'environment' => $this->environment
            ])
            ->registerProvider(RouterServiceProvider::class, [
                'routes' => $this->configuration['routes'],
                'request' => $this->container->get('request')
            ])
            ->registerProvider(pizzaORMServiceProvider::class, $this->configuration['pizzaorm']);


        if (isset($this->configuration['app']['services'])) {
            foreach ((array) $this->configuration['app']['services'] as $key => $service) {
                r($key, $service);
            }
        }

        return $this;
    }

    public function dispatchRequest(): Dispatcher
    {
        $dispatcher = new Dispatcher();
        $dispatcher->setContainer($this->container)
            ->setRootDir($this->getRootDir())
            ->setPublicDir($this->getRootDir());

        return $dispatcher->dispatch();
    }
}