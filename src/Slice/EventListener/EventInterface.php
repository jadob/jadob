<?php


namespace Slice\EventListener;

use Slice\Router\Route;
use Symfony\Component\HttpFoundation\Response;

interface EventInterface
{
    public function onBeforeRouterAction();

    public function onAfterRouterAction(Route $route);

    public function onBeforeControllerAction();

    public function onAfterControllerAction(Response $response);

    public function isEventStoppingPropagation();

}