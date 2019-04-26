<?php

namespace Jadob\Core;

use Jadob\Security\Auth\User\UserInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ControllerUtils
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
abstract class AbstractController
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * ControllerUtils constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public function renderTemplate(string $templateName, array $data = []): string
    {
        return $this->container->get('twig')->render($templateName, $data);
    }

    /**
     * @return FormFactory
     */
    public function getFormFactory(): FormFactory
    {
        return $this->container->get('symfony.form.factory');
    }

    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->container->get('auth.user.storage')->getUser();
    }

    /**
     * @param string $type
     * @param string $message
     */
    public function addFlash($type, $message): void
    {
        $this->container->get('session')->getFlashBag()->add($type, $message);
    }

    /**
     * @param string $name
     * @param array $params
     * @param bool $full
     * @return string
     */
    public function generateRoute($name, array $params = [], $full = false): string
    {
        return $this->container->get('router')->generateRoute($name, $params, $full);
    }

    /**
     * @param string $name
     * @param array $params
     * @return RedirectResponse
     * @throws \InvalidArgumentException
     */
    public function createRedirectToRouteResponse(string $name, array $params = []): RedirectResponse
    {
        return new RedirectResponse($this->generateRoute($name, $params));
    }


    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->container->get('request');
    }

}