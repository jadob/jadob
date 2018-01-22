<?php

namespace Slice\Security\Auth\Event;

use Slice\EventListener\AbstractEvent;
use Slice\EventListener\Event\AfterRouterEvent;
use Slice\Router\Route;
use Slice\Router\Router;
use Slice\Security\Auth\AuthenticationManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LogoutListener
 * @package Slice\Security\Auth\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class LogoutListener extends AbstractEvent
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
     * @param Route $route
     * @return null|void
     * @throws \InvalidArgumentException
     * @throws \Slice\Router\Exception\RouteNotFoundException
     */
    public function onAfterRouterAction(AfterRouterEvent $event)
    {
        $route = $event->getRoute();

        if (
            $route->getName() !== $this->config['logout_path'] //route does not match
            || $this->manager->getUserStorage()->getUser() === null //user is logged in
        ) {
            return;
        }

        $this->manager->logout();
        $event->setResponse(new RedirectResponse($this->router->generateRoute($this->config['logout_redirect'])));
    }
}