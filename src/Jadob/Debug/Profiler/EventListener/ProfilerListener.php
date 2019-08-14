<?php

namespace Jadob\Debug\Profiler\EventListener;


use Jadob\Debug\Profiler\Profiler;
use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\Type\AfterControllerEventListenerInterface;
use Jadob\Router\Router;

/**
 * Class ProfilerListener
 * @package Jadob\Debug\Profiler\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ProfilerListener implements AfterControllerEventListenerInterface
{

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Profiler
     */
    protected $profiler;

    /**
     * ProfilerListener constructor.
     * @param Router $router
     * @param Profiler $profiler
     */
    public function __construct(Router $router, Profiler $profiler)
    {
        $this->router = $router;
        $this->profiler = $profiler;
    }

    /**
     * @param AfterControllerEvent $event
     * @return void
     */
    public function onAfterControllerEvent(AfterControllerEvent $event)
    {
        $content = $event->getResponse()->getContent();

//        ob_start();
//        $coverageUrl = $this->router->generateRoute('jadob_profiler_coverage', ['id' => $this->profiler->getRequestId()]);
//        include __DIR__ . '/../../templates/profiler.php';
//        $profiler = \ob_get_clean();

//        $content = \str_replace('</body>', $profiler . '</body>', $content);
        $event->getResponse()->setContent($content);
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return false;
    }
}