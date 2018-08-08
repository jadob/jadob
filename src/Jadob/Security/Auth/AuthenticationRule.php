<?php

namespace Jadob\Security\Auth;

/**
 * Any single authentication rule
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthenticationRule
{
    /**
     * @var string
     */
    protected $userProvider;

    /**
     * @var array
     */
    protected $providerSettings;

    /**
     * @var string|null
     */
    protected $loginRedirectPath;

    /**
     * @var string|null
     */
    protected $logoutRedirectPath;

    /**
     * @var string|null
     */
    protected $loginPath;

    /**
     * @var string|null
     */
    protected $logoutPath;

    /**
     * @var bool
     */
    protected $stateless = false;



    /**
     * @var string
     */
    protected $name;

    /**
     * if false - any allowed, otherwise only these passed in array
     * @var array|false
     */
    protected $allowedMethods = false;

    /**
     * @param array $data
     * @param string $name
     * @throws \RuntimeException
     */
    public static function fromArray($data, $name)
    {
//        r($data);
        $object = new self($name);

        if(!isset($data['user_provider'])) {
            throw new \RuntimeException('Rule "'.$name.'" has no user provider passed.');
        }

        $object->setUserProvider($data['user_provider']);
        $object->setProviderSettings($data['provider_settings']);

        if(isset($data['allowed_methods'])) {
            $object->setAllowedMethods($data['allowed_methods']);
        }

        if(isset($data['redirect_path'])) {
            $object->setLoginRedirectPath($data['redirect_path']);
        }

        if(isset($data['logout_redirect'])) {
            $object->setLoginRedirectPath($data['logout_redirect']);
        }

        if (isset($data['login_path'])) {
            $object->setLoginPath($data['login_path']);
        }

        if (isset($data['logout_path'])) {
            $object->setLogoutPath($data['logout_path']);
        }

        if(isset($data['stateless'])) {
            $object->setStateless($data['stateless']);
        }
        
        return $object;
    }

    /**
     * AuthenticationRule constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUserProvider(): string
    {
        return $this->userProvider;
    }

    /**
     * @param string $userProvider
     * @return AuthenticationRule
     */
    public function setUserProvider(string $userProvider): AuthenticationRule
    {
        $this->userProvider = $userProvider;
        return $this;
    }

    /**
     * @return array
     */
    public function getProviderSettings(): array
    {
        return $this->providerSettings;
    }

    /**
     * @param array $providerSettings
     * @return AuthenticationRule
     */
    public function setProviderSettings(array $providerSettings): AuthenticationRule
    {
        $this->providerSettings = $providerSettings;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLoginRedirectPath(): ?string
    {
        return $this->loginRedirectPath;
    }

    /**
     * @param null|string $loginRedirectPath
     * @return AuthenticationRule
     */
    public function setLoginRedirectPath(?string $loginRedirectPath): AuthenticationRule
    {
        $this->loginRedirectPath = $loginRedirectPath;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLogoutRedirectPath(): ?string
    {
        return $this->logoutRedirectPath;
    }

    /**
     * @param null|string $logoutRedirectPath
     * @return AuthenticationRule
     */
    public function setLogoutRedirectPath(?string $logoutRedirectPath): AuthenticationRule
    {
        $this->logoutRedirectPath = $logoutRedirectPath;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLoginPath(): ?string
    {
        return $this->loginPath;
    }

    /**
     * @param null|string $loginPath
     * @return AuthenticationRule
     */
    public function setLoginPath(?string $loginPath): AuthenticationRule
    {
        $this->loginPath = $loginPath;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLogoutPath(): ?string
    {
        return $this->logoutPath;
    }

    /**
     * @param null|string $logoutPath
     * @return AuthenticationRule
     */
    public function setLogoutPath(?string $logoutPath): AuthenticationRule
    {
        $this->logoutPath = $logoutPath;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStateless(): bool
    {
        return $this->stateless;
    }

    /**
     * @param bool $stateless
     * @return AuthenticationRule
     */
    public function setStateless(bool $stateless): AuthenticationRule
    {
        $this->stateless = $stateless;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AuthenticationRule
     */
    public function setName(string $name): AuthenticationRule
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array|false
     */
    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }

    /**
     * @param array|false $allowedMethods
     * @return AuthenticationRule
     */
    public function setAllowedMethods($allowedMethods)
    {
        $this->allowedMethods = $allowedMethods;
        return $this;
    }


}