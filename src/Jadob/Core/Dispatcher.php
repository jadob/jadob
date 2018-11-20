<?php

namespace Jadob\Core;

use Jadob\Router\Router;
use Jadob\Security\Auth\AuthenticationManager;
use Jadob\Security\Firewall\Firewall;
use ReflectionMethod;
use Jadob\Container\Container;
use Jadob\Core\Exception\DispatcherException;
use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\EventListener;
use Jadob\Router\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Config\Config;

/**
 * @deprecated remove or make it better
 * Class Dispatcher
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Dispatcher
{

    /**
     * @var string
     */
    private $env;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var Container
     */
    private $container;

    /**
     * Dispatcher constructor.
     * @param string $env
     * @param Config $config
     * @param Container $container
     */
    public function __construct($env, \Zend\Config\Config $config, Container $container)
    {
        $this->env = $env;
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * @return EventListener
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function getEventDispatcher()
    {
        return $this->container->get('event.listener');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \ReflectionException
     * @throws DispatcherException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function execute(Request $request): Response
    {
        /** @var Router $router */
        $router = $this->container->get('router');
        /** @var Route $route */
        $route = $router->matchRoute($request);
        /** @var Firewall $firewall */
        $firewall = $this->container->get('firewall');
        /** @var AuthenticationManager $manager */
        $manager = $this->container->get('auth.authentication.manager');

        $routeName = $route->getName();

        /**
         * Excluded routes can be eg. login/logout paths for non-stateless rules, we need to werify that
         * @TODO rewrite and optimize
         */
        foreach ($firewall->getExcludedRoutePatterns() as $excludedRoute) {
            //turn string to regexp
            $excludedRoute = $this->prepareFirewallPattern(
                $excludedRoute
            );

            if ((bool)\preg_match($excludedRoute, $routeName)) {

                foreach ($manager->getAuthenticationRules() as $authenticationRule) {

                    //catch if current route is login route
                    if (
                        !$authenticationRule->isStateless()
                        && $authenticationRule->getLoginPath() === $routeName
                        && ($token = $manager->getExtractor($authenticationRule->getExtractor())->getCredentialsFromRequest($request)) !== null
                    ) {
                        $manager->setCurrentAuthRuleName($authenticationRule->getName());

                        $loginResult = $manager->login($token, $authenticationRule);

                        if ($loginResult === true) {
                            return new RedirectResponse(
                                $router->generateRoute(
                                    $authenticationRule->getLoginRedirectPath()
                                )
                            );
                        }


                        //at this place we should log our user
                    }
                }
            }
        }


        /**
         * If route isnt whitelisted, we should iterate firewall rules and match
         */
//        if(!$isWhitelisted) {
        $overrideController = false;
        foreach ($firewall->getRules() as $firewallRule) {

            $firewallPattern = $this->prepareFirewallPattern(
                $firewallRule->getRoutePattern()
            );

            if ((bool)\preg_match($firewallPattern, $routeName)) {

                $manager->setCurrentAuthRuleName($firewallRule->getAuthenticationRule());

                $controllerClassName = $firewallRule->getAccessDeniedController();
                $action = null;

                $user = $manager->getUserStorage()->getUser();
                $userRoles = [];

                if ($user !== null) {
                    $userRoles = $user->getRoles();
                }

                if ($user === null
                    && \count(array_intersect(
                            $firewallRule->getRoles(),
                            $userRoles
                        )
                    ) === 0) {
                    $overrideController = true;
                }
            }
        }

        $afterRouterObject = new AfterRouterEvent($route, null);

        $this->getEventDispatcher()->dispatchAfterRouterAction($afterRouterObject);

        $route = $afterRouterObject->getRoute();

        if (($afterRouterResponse = $afterRouterObject->getResponse()) !== null) {
            return $afterRouterResponse;
        }

        if (!$overrideController) {
            $controllerClassName = $route->getController();
        }

        if (!\class_exists($controllerClassName)) {
            throw new DispatcherException('Class "' . $controllerClassName . '" '
                . 'does not exists or it cannot be used as a controller.');
        }


        $controller = $this->autowireControllerClass($controllerClassName);

        if (!$overrideController) {
            $action = $route->getAction();
        }


        if ($action === null && !method_exists($controller, '__invoke')) {
            throw new \RuntimeException('Class "' . \get_class($controller) . '" has neither action nor __invoke() method defined.');
        }

        $action = ($action === null) ? '__invoke' : $action . 'Action';

        if (!method_exists($controller, $action)) {
            throw new DispatcherException('Action "' . $action . '" does not exists in ' . \get_class($controller));
        }

        $params = $this->getOrderedParamsForAction($controller, $action, $route);

        /** @var Response $response */
        $response = \call_user_func_array([$controller, $action], $params);

        $afterControllerEvent = new AfterControllerEvent($response);

        $response = $this->getEventDispatcher()->dispatchAfterControllerAction($afterControllerEvent);

//        if ($afterControllerListener !== null) {
//            $response = $afterControllerListener;
//        }

        $response->prepare($request);
        //TODO: Response validation
//        if (!in_array(Response::class, class_parents($response), true)) {
//            throw new DispatcherException('Invalid response type');
//        }


        //enable pretty print for JsonResponse objects in dev environment
        if ($response instanceof JsonResponse && $this->env === 'dev') {
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        }

        return $response;
    }

    /**
     * @param $controller
     * @param $action
     * @param Route $route
     * @return array
     * @throws \ReflectionException
     */
    private function getOrderedParamsForAction($controller, $action, Route $route): array
    {
        $reflection = new ReflectionMethod($controller, $action);

        $params = $route->getParams();

        $output = [];
        foreach ($reflection->getParameters() as $parameter) {
            $routeName = $parameter->getName();
            $output[$routeName] = $params[$routeName];
        }

        return $output;
    }

    /**
     * @param $className
     * @return array
     * @throws \RuntimeException
     * @throws \ReflectionException
     */
    private function getControllerConstructorArguments($className)
    {

        $reflection = new \ReflectionClass($className);

        $controllerConstructor = $reflection->getConstructor();

        if ($controllerConstructor === null) {
            return [];
        }

        $controllerParameters = $controllerConstructor->getParameters();
        $controllerConstructorArgs = [];

        foreach ($controllerParameters as $parameter) {

            if ($parameter->getType() === null) {
                throw new \RuntimeException('Constructor argument "' . $parameter->getName() . '" has no type.');
            }

            $argumentType = (string)$parameter->getType();
            if ($argumentType === Container::class) {
                $controllerConstructorArgs[] = $this->container;
                break;
            }

            $controllerConstructorArgs[] = $this->container->findServiceByClassName($argumentType);
        }

        return $controllerConstructorArgs;

    }

    /**
     * Finds depedencies for controller object and instatiate it.
     * @param string $controllerClassName
     * @return mixed
     * @throws \RuntimeException
     * @throws \ReflectionException
     */
    public function autowireControllerClass($controllerClassName)
    {
        $controllerConstructorArgs = $this->getControllerConstructorArguments($controllerClassName);
        return new $controllerClassName(...$controllerConstructorArgs);
    }


    /**
     * turns string to regexp pattern.
     * @param string $pattern
     * @return string
     */
    protected function prepareFirewallPattern($pattern): string
    {
        $pattern = \str_replace('*', '(.*)', $pattern);
        return '@' . $pattern . '@iu';
    }


}
