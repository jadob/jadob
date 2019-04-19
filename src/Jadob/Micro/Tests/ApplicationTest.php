<?php

namespace Jadob\Micro\Tests;

use Jadob\Micro\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApplicationTest
 * @package Jadob\Router\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ApplicationTest extends TestCase
{

    public function setUp()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['SERVER_PORT'] = 8001;
    }

    public function testGetRoute()
    {

        $application = new Application();

        $application->get('/', function () {
            return new Response('yay');
        });

        $this->assertEquals('yay', $application->handleRequest(new Request())->getContent());

    }
}