<?php

namespace Jadob\Core;

use Jadob\Security\Auth\User\UserInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactory;

/**
 * Class ControllerUtils
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ControllerUtils
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


    public function renderTemplate($templateName, $data = [])
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
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->container->get('auth.user.storage')->getUser();
    }

    public function addFlash($type, $message)
    {
        $this->container->get('session')->getFlashBag()->add($type, $message);
    }

    public function generateRoute($name, array $params = [], $full = false)
    {
        return $this->container->get('router')->generateRoute($name, $params, $full);
    }

}