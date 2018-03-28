<?php

namespace Jadob\Security\Firewall;

use Jadob\Security\Auth\User;

class RuleMatcher
{

    /**
     * @var array
     */
    protected $rule;

    /**
     * @var User|null
     */
    protected $user;


    public function __construct(array $rule, $user)
    {
        $this->rule = $rule;
        $this->user = $user;

    }

    public function isRuleMatching()
    {
        return $this->hasRoles();
    }

    protected function hasRoles()
    {

        //if there is no roles defined, we assume that user has required roles
        if (!isset($this->rule['roles'])) {
            return true;
        }

        //if roles are set, it means that user have to be logged in. We cant allow unlogged user access protected things.
        if ($this->user === null) {
            return false;
        }

        $roles = array_intersect($this->rule['roles'], $this->user->getRoles());

        return \count($roles) > 0;
    }
}