<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\User;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface UserInterface
{

    /**
     * @return string[]
     */
    public function getRoles();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return mixed
     */
    public function getUsername();
}