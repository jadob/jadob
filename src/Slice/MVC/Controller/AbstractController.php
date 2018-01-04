<?php

namespace Slice\MVC\Controller;

use Slice\Container\Container;
use Slice\Container\ContainerAwareTrait;
use Slice\Database\Database;
use Slice\Form\FormFactory;
use Slice\MVC\ResponseMethodsTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 * @package Slice\MVC\Controller
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
abstract class AbstractController
{

    use ContainerAwareTrait;
    use ResponseMethodsTrait;

    /**
     * AbstractController constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Database
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function getDatabase()
    {
        return $this->get('database');
    }

    /**
     * @param string $modelName Model name to be returned
     * @return \Slice\Database\Model\AbstractModel
     * @throws \Exception
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function getModel($modelName)
    {
        return $this->getDatabase()->getModel($modelName);
    }

    /**
     * @return Request
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function getRequest()
    {
        return $this->get('request');
    }

    /**
     * @param string $name global variable name (defined in config.php, 'globals' section)
     * @return mixed
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    protected function getGlobal($name)
    {

        return $this->get('globals')->get($name);
    }

    /**
     * @return FormFactory
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    protected function getFormFactory()
    {

        return $this->get('form.factory');
    }
}