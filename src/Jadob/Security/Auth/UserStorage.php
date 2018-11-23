<?php

namespace Jadob\Security\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class UserStorage
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UserStorage
{

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * UserStorage constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

}