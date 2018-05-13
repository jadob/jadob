<?php

namespace Jadob\Security\Auth\Event;

use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\Event\Type\AfterRouterListenerInterface;
use Jadob\EventListener\EventInterface;
use Jadob\Router\Router;
use Jadob\Security\Auth\AuthenticationManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LogoutListener
 * @package Jadob\Security\Auth\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class LogoutListener implements EventInterface, AfterRouterListenerInterface
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var AuthenticationManager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Router
     */
    protected $router;

    /**
     * AuthListener constructor.
     * @param Request $request
     * @param AuthenticationManager $manager
     */
    public function __construct(Request $request, AuthenticationManager $manager, $config, Router $router)
    {
        $this->request = $request;
        $this->manager = $manager;
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return true;
    }

    /**
     * @param AfterRouterEvent $event
     * @return null|void
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function onAfterRouterAction(AfterRouterEvent $event)
    {
        $route = $event->getRoute();

        if ($route->getName() !== $this->config['logout_path']) { //route does not match
            return;
        }

        $this->manager->logout();
        $event->setResponse(new RedirectResponse($this->router->generateRoute($this->config['logout_redirect'])));
    }
}