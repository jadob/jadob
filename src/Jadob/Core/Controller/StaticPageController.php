<?php
declare(strict_types=1);

namespace Jadob\Core\Controller;

use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Core\AbstractController;
use Jadob\Router\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * When the only thing you require from given Controller is to render some static page,
 * you can use this one in your route configuration to reduce your codebase.
 *
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class StaticPageController extends AbstractController
{

    /**
     * @param Route $route
     * @return Response
     * @throws ServiceNotFoundException
     */
    public function __invoke(Route $route)
    {
        $template = $route->getParams()['template_name'];
        return new Response($this->renderTemplate($template));
    }
}