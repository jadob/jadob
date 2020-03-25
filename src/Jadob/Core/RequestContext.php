<?php
declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Router\Context;
use Jadob\Router\Route;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RequestContext
{
    protected string $requestId;
    protected Request $request;
    protected Context $context;
    protected Route $route;
    protected ?RequestSupervisorInterface $supervisor;
    protected bool $psr7Complaint;

    public function __construct(string $requestId, Request $request, bool $psr7Complaint)
    {
        $this->requestId = $requestId;
        $this->request = $request;
        $this->psr7Complaint = $psr7Complaint;
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
     * @param RequestSupervisorInterface|null $supervisor
     */
    public function setSupervisor(?RequestSupervisorInterface $supervisor): void
    {
        $this->supervisor = $supervisor;
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
     * @return RequestSupervisorInterface|null
     */
    public function getSupervisor(): ?RequestSupervisorInterface
    {
        return $this->supervisor;
    }

    /**
     * @return bool
     */
    public function isPsr7Complaint(): bool
    {
        return $this->psr7Complaint;
    }


}