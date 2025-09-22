<?php

declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Contracts\Auth\AccessToken;
use Jadob\Contracts\Auth\IdentityInterface;
use Jadob\Router\RouterContext;
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
    protected Route $route;
    /**
     * @deprecated
     * @var UserInterface|null
     */
    protected ?UserInterface $user = null;
    protected(set) ?AccessToken $accessToken = null;
    protected(set) ?IdentityInterface $identity = null;

    public function __construct(
        protected(set) string $requestId,
        protected(set) Request $request
    )
    {
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
     * @deprecated
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface|null $user
     * @return RequestContext
     * @deprecated
     */
    public function setUser(?UserInterface $user): RequestContext
    {
        $this->user = $user;
        return $this;
    }

    public function setAccessToken(
        AccessToken $accessToken
    ): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function setIdentity(?IdentityInterface $identity): void
    {
        $this->identity = $identity;
    }
}