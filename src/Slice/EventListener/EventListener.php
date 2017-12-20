<?php

namespace Slice\EventListener;

use Symfony\Component\HttpFoundation\Request;


/**
 * Class EventListener
 * Service name: event.listener
 * @package Slice\EventDispatcher
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class EventListener
{
    /**
     * All events container.
     * @var array
     */
    protected $events;

    protected $request;

    protected $response;

    public function __construct(Request $request)
    {

    }

    public function addEvent($eventName, Event $event, $prority = null)
    {

    }

    public function dispatchEvent($eventName)
    {

    }
}