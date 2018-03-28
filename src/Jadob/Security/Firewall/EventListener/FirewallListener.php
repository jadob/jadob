<?php

namespace Jadob\Security\Firewall\EventListener;

use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\Event\Type\AfterRouterListenerInterface;
use Jadob\EventListener\EventInterface;
use Jadob\Router\Router;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Firewall\RuleMatcher;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FirewallListener
 * @package Jadob\Security\Firewall\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FirewallListener implements EventInterface, AfterRouterListenerInterface
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var UserStorage
     */
    protected $userStorage;

    /**
     * @var array[]
     */
    protected $config;

    /**
     * @var Router
     */
    protected $router;

    /**
     * FirewallListener constructor.
     * @param Request $request
     * @param UserStorage $userStorage
     * @param $config
     * @param Router $router
     */
    public function __construct(Request $request, UserStorage $userStorage, $config, Router $router)
    {
        $this->request = $request;
        $this->userStorage = $userStorage;
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * @param AfterRouterEvent $route
     * @throws \InvalidArgumentException
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function onAfterRouterAction(AfterRouterEvent $route)
    {

        $path = $this->request->getPathInfo();

        foreach ($this->config['firewall']['rules'] as $ruleName => $rule) {
            //if rule has a 'pattern', match it with $path
            // if false, go to another rule
            // if not present, throw exception

            if (!isset($rule['pattern'])) {
                throw new \RuntimeException('Rule "' . $ruleName . '" has no pattern.');
            }

            if (isset($rule['roles']) && !\is_array($rule['roles'])) {
                throw new \RuntimeException('"roles" parameter in "' . $ruleName . '" rule should be an array.');
            }

            $pattern = '#^' . $rule['pattern'] . '$#';

            if ((bool)preg_match($pattern, $path)) {

                $matcher = new RuleMatcher($rule, $this->userStorage->getUser());

                if (!$matcher->isRuleMatching()) {
                    $route->setResponse(
                        new RedirectResponse(
                            $this->router->generateRoute(
                                $this->config['auth']['login_path'],
                                ['redirect_uri' => $path]
                            )
                        )
                    );
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return true;
    }
}