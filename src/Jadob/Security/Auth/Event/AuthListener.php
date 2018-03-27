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
 * Class AuthListener
 * @package Jadob\Security\Auth\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthListener implements EventInterface, AfterRouterListenerInterface
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
     * @throws \InvalidArgumentException
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function onAfterRouterAction(AfterRouterEvent $event)
    {

        $route = $event->getRoute();

        if (
            $this->request->getMethod() !== 'POST' //not POST request
            || $route->getName() !== $this->config['login_path'] //route does not match
            || $this->manager->getUserStorage()->getUser() !== null //user is logged in
        ) {

            return;
        }

        $isLogged = $this->manager->handleRequest($this->request);

        $redirectPath = $this->config['redirect_path'];

        $redirectUri = $this
            ->router
            ->generateRoute(
                $redirectPath
            );


        if ($this->request->query->has('redirect_uri')) {
            $redirectUri = $this->request->query->get('redirect_uri');
        }

        if ($isLogged) {
            $event->setResponse(new RedirectResponse($redirectUri));
        }
    }
}