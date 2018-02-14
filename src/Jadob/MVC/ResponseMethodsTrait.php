<?php

namespace Jadob\MVC;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ResponseMethodsTrait
 * @package Jadob\MVC
 */
trait ResponseMethodsTrait
{

    /**
     * @param $templateName
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function renderTemplateResponse($templateName, $data = [], $status = 200, $headers = [])
    {

        $output = $this->get('twig')->render($templateName, $data);
        return new Response($output, $status, $headers);
    }

    /**
     * @param $name
     * @param $params
     * @param bool $full
     * @return RedirectResponse
     * @throws \InvalidArgumentException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function redirectToRoute($name, $params = [], $full = false)
    {
        return new RedirectResponse($this->get('router')->generateRoute($name, $params, $full));
    }
}