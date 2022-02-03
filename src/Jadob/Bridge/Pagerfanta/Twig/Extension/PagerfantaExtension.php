<?php

declare(strict_types=1);

namespace Jadob\Bridge\Pagerfanta\Twig\Extension;

use Jadob\Router\Router;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap3View;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class PagerfantaProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class PagerfantaExtension extends AbstractExtension
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Router
     */
    protected $router;

    /**
     * PagerfantaExtension constructor.
     *
     * @param Request $request
     * @param Router  $router
     */
    public function __construct(Request $request, Router $router)
    {
        $this->request = $request;
        $this->router = $router;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('pagerfanta', [$this, 'createPaginator'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param  Pagerfanta $pagerfanta
     * @return mixed
     */
    public function createPaginator(Pagerfanta $pagerfanta)
    {
        $view = new TwitterBootstrap3View();
        $options = ['proximity' => 3];
        return $view->render($pagerfanta, [$this, 'generateRoute'], $options);
    }

    /**
     * @param  $page
     * @return mixed|string
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function generateRoute($page)
    {
        $queryParams = $this->request->query->all();
        $queryParams['page'] = $page;

        return $this->router->generateRoute($this->router->getCurrentRoute()->getName(), $queryParams);
    }
}