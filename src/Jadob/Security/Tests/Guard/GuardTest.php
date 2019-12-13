<?php

namespace Jadob\Security\Tests\Guard;

use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Guard\Guard;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class GuardTest
 *
 * @package Jadob\Security\Tests\Guard
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class GuardTest extends TestCase
{

    public function testExcludedPathsMatching()
    {

        $excludedPaths = [
            '/login',
            '/page/(.*)'
        ];

        $guard = new Guard(new UserStorage(new Session()), $excludedPaths);

        $this->assertTrue($guard->isPathExcluded('/login'));
        $this->assertTrue($guard->isPathExcluded('/page/stuff'));
        $this->assertTrue($guard->isPathExcluded('/page/stuff2.xml'));
        $this->assertTrue($guard->isPathExcluded('/page/kinda-of-text'));
        $this->assertFalse($guard->isPathExcluded('/site/kinda-of-text'));
        $this->assertFalse($guard->isPathExcluded('/'));
        $this->assertFalse($guard->isPathExcluded('/register'));

    }
}