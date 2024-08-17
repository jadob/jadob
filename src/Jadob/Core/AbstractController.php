<?php
declare(strict_types=1);

namespace Jadob\Core;

use InvalidArgumentException;
use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

/**
 * This is a base class for your controller which exposes some basic features required in most cases.
 *
 * It is not required for your actions to extend this class. Feel free to ignore it and reach all your required
 * services via action arguments or create your own AbstractController class.
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Constructor cannot be overriden in this case as this abstract rely on it.
     *
     * @param ContainerInterface $container
     */
    final public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     * @throws ServiceNotFoundException
     */
    protected function renderTemplate(string $templateName, array $data = []): string
    {
        return $this->container->get(Environment::class)->render($templateName, $data);
    }

    /**
     * @return FormFactory
     * @throws ServiceNotFoundException
     */
    protected function getFormFactory(): FormFactory
    {
        return $this->container->get('symfony.form.factory');
    }

    /**
     * @param string $type
     * @param null $data
     * @param array $options
     * @return \Symfony\Component\Form\FormInterface
     * @throws ServiceNotFoundException
     */
    public function createForm(string $type, $data = null, array $options = [])
    {
        return $this->getFormFactory()->create($type, $data, $options);
    }


    /**
     * @param string $name
     * @param array $params
     * @param bool $full
     * @return string
     * @throws ServiceNotFoundException
     */
    protected function generateRoute($name, array $params = [], $full = false): string
    {
        return $this->container->get('router')->generateRoute($name, $params, $full);
    }


    /**
     * @param $name
     * @param array $params
     * @return string
     * @throws ServiceNotFoundException
     * @throws \Jadob\Container\Exception\ContainerException
     */
    protected function url($name, array $params = []): string
    {
        return $this->container->get('router')->generateRoute($name, $params, true);
    }

    /**
     * @param string $name
     * @param array $params
     * @return RedirectResponse
     * @throws InvalidArgumentException
     */
    protected function createRedirectToRouteResponse(string $name, array $params = []): RedirectResponse
    {
        return new RedirectResponse($this->generateRoute($name, $params));
    }


    /**
     * @return Request
     * @throws ServiceNotFoundException
     * @deprecated - reach given request via action argument
     */
    protected function getRequest(): Request
    {
        return $this->container->get('request');
    }

    /**
     * @param  $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    protected function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @param $level
     * @param $message
     * @param array $context
     *
     * @return void
     * @throws ServiceNotFoundException
     */
    protected function log($level, $message, array $context = []): void
    {
        $this->container->get(LoggerInterface::class)->log($level, $message, $context);
    }
}