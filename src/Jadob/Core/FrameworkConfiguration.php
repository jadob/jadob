<?php

namespace Jadob\Core;

use Jadob\Core\Controller\ErrorController;
use Jadob\Router\Route;

/**
 * Kernel configuration.
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FrameworkConfiguration
{
    /**
     * @var Route
     */
    protected $errorControllerRoute;

    public function __construct($data)
    {
        $this->errorControllerRoute = (new Route('prod_error_controller'))
            ->setController(ErrorController::class)
            ->setAction('errorAction');

        if (isset($data['error_controller'])) {
            $this->errorControllerRoute = (new Route('prod_error_controller'))
                ->setController($data['error_controller']['controller'])
                ->setAction($data['error_controller']['action']);
        }
    }

    /**
     * @return Route
     */
    public function getErrorControllerRoute(): Route
    {
        return $this->errorControllerRoute;
    }

    /**
     * @param Route $errorControllerRoute
     * @return FrameworkConfiguration
     */
    public function setErrorControllerRoute(Route $errorControllerRoute): FrameworkConfiguration
    {
        $this->errorControllerRoute = $errorControllerRoute;
        return $this;
    }


}