<?php
declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Security\Auth\User\UserInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

/**
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
     * ControllerUtils constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param  string $templateName
     * @param  array  $data
     * @return string
     */
    protected function renderTemplate(string $templateName, array $data = []): string
    {
        return $this->container->get(Environment::class)->render($templateName, $data);
    }

    /**
     * @return FormFactory
     */
    protected function getFormFactory(): FormFactory
    {
        return $this->container->get('symfony.form.factory');
    }

    /**
     * @return UserInterface|null
     */
    protected function getUser(): ?UserInterface
    {
        return $this->container->get('auth.user.storage')->getUser();
    }


    /**
     * @param  string $name
     * @param  array  $params
     * @param  bool   $full
     * @return string
     */
    protected function generateRoute($name, array $params = [], $full = false): string
    {
        return $this->container->get('router')->generateRoute($name, $params, $full);
    }

    /**
     * @param  string $name
     * @param  array  $params
     * @return RedirectResponse
     * @throws \InvalidArgumentException
     */
    protected function createRedirectToRouteResponse(string $name, array $params = []): RedirectResponse
    {
        return new RedirectResponse($this->generateRoute($name, $params));
    }


    /**
     * @return Request
     */
    protected function getRequest(): Request
    {
        return $this->container->get('request');
    }

    /**
     * @param  $id
     * @return mixed
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
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
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     *
     * @return void
     */
    protected function log($level, $message, array $context = []): void
    {
        $this->container->get(LoggerInterface::class)->log($level, $message, $context);
    }

}