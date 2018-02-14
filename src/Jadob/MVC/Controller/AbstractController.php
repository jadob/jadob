<?php

namespace Jadob\MVC\Controller;

use Jadob\Container\Container;
use Jadob\Container\ContainerAwareTrait;
use Jadob\Database\Database;
use Jadob\Form\FormFactory;
use Jadob\MVC\ResponseMethodsTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class AbstractController
 * @package Jadob\MVC\Controller
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
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function getDatabase()
    {
        return $this->get('database');
    }

    /**
     * @param string $modelName Model name to be returned
     * @return \Jadob\Database\Model\AbstractModel
     * @throws \Exception
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function getModel($modelName)
    {
        return $this->getDatabase()->getModel($modelName);
    }

    /**
     * @return Request
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function getRequest()
    {
        return $this->get('request');
    }

    /**
     * @param string $name global variable name (defined in config.php, 'globals' section)
     * @return mixed
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function getGlobal($name)
    {

        return $this->get('globals')->get($name);
    }

    /**
     * @return FormFactory
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function getFormFactory()
    {

        return $this->get('form.factory');
    }

    protected function getUser()
    {

    }

    /**
     * @param $type
     * @param $message
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function addFlash($type, $message)
    {
        $this->get('session')->getFlashBag()->add($type, $message);
    }
}