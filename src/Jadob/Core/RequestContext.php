<?php
declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Router\Context;
use Jadob\Router\Route;
use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RequestContext
{
    protected string $requestId;
    protected Request $request;
    protected ?Context $context = null;
    protected Route $route;
    protected ?UserInterface $user = null;

    public function __construct(string $requestId, Request $request)
    {
        $this->requestId = $requestId;
        $this->request = $request;
    }

    /**
     * @param Context $context
     */
    public function setContext(Context $context): void
    {
        $this->context = $context;
    }

    /**
     * @param Route $route
     */
    public function setRoute(Route $route): void
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Context
     */
    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->request->getSession();
    }

    /**
     * @param SessionInterface $session
     * @return RequestContext
     */
    public function setSession(SessionInterface $session): RequestContext
    {
        $this->request->setSession($session);
        return $this;
    }

    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface|null $user
     * @return RequestContext
     */
    public function setUser(?UserInterface $user): RequestContext
    {
        $this->user = $user;
        return $this;
    }
}