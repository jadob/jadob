<?php

namespace Jadob\Security\Supervisor;

use Jadob\Security\Auth\UserProviderInterface;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Supervisor
{

    public const POLICY_UNSECURED_BLOCK = 1;

    public const POLICY_UNSECURED_ALLOW = 2;

    /**
     * How supervisor should behave when no RequestSupervisor matched for request?
     * @var int
     */
    protected $unsecuredRequestPolicy;

    /**
     * @var RequestSupervisorInterface[]
     */
    protected $requestSupervisors = [];

    /**
     * @var UserProviderInterface[]
     */
    protected $userProviders = [];

    /**
     * @param Request $request
     * @return RequestSupervisorInterface|null
     */
    public function matchRequestSupervisor(Request $request): ?RequestSupervisorInterface
    {
        foreach ($this->requestSupervisors as $requestSupervisor) {
            if ($requestSupervisor->supports($request)) {
                return $requestSupervisor;
            }
        }

        return null;
    }

    //@todo refactor
    public function addRequestSupervisor(string $name, RequestSupervisorInterface $requestSupervisor, UserProviderInterface $userProvider)
    {
        $this->requestSupervisors[$name] = $requestSupervisor;
        $this->userProviders[\spl_object_hash($requestSupervisor)] = $userProvider;
    }

    //@TODO refactor
    public function getUserProviderForSupervisor(RequestSupervisorInterface $supervisor)
    {
        return $this->userProviders[\spl_object_hash($supervisor)];
    }
    /**
     * to be deprecated probably
     * @return bool
     */
    public function isBlockingUnsecuredRequests()
    {
        return $this->unsecuredRequestPolicy === self::POLICY_UNSECURED_BLOCK;
    }
}