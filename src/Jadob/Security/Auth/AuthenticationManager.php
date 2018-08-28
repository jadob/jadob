<?php

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\CredentialExtractor\ExtractorInterface;
use Jadob\Security\Auth\CredentialExtractor\JsonBodyExtractor;
use Jadob\Security\Auth\Exception\UserNotFoundException;
use Jadob\Security\Auth\Provider\UserProviderFactoryInterface;
use Jadob\Security\Auth\Provider\UserProviderInterface;
use Jadob\Security\Firewall\FirewallRule;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationManager
 * @TODO:
 * - add some user class, which will be serialized and stored in session (*)
 * - allow developer to make his own User class (*)
 * - allow to store more than one auth rule (*)
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthenticationManager
{
    /**
     * @var UserStorage
     */
    protected $userStorage;

    /**
     * @var string
     */
    protected $error;

    /**
     * @var string
     */
    protected $lastUsername;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @deprecated so far
     * @var UserProviderInterface[]
     */
    protected $userProviders = [];

    /**
     * @var UserProviderFactoryInterface[]
     */
    protected $userProviderFactories;

    /**
     * @var array
     */
    protected $config;

    /**
     * @deprecated
     * @var string
     */
    protected $userProviderName;

    /**
     * @var AuthenticationRule[]
     */
    protected $authenticationRules = [];

    /**
     * @var FirewallRule|null
     */
    protected $firewallRule;

    /**
     * @var AuthenticationRule
     */
    protected $defaultRule;

    /**
     * @var ExtractorInterface[]
     */
    protected $extractors;

    /**
     * @var string
     */
    protected $currentAuthRuleName;

    /**
     * AuthenticationManager constructor.
     * @param UserStorage $userStorage
     * @param LoggerInterface $logger
     */
    public function __construct(
        UserStorage $userStorage,
        LoggerInterface $logger = null
    )
    {
        $this->userStorage = $userStorage;
        $this->logger = $logger;

        $this->extractors = [
            'json' => new JsonBodyExtractor()
        ];
    }

    /**
     * @param Token $token
     * @param AuthenticationRule $rule
     * @return bool
     */
    public function login(Token $token, AuthenticationRule $rule)
    {

        $userProviderFactory = $this->userProviderFactories[$rule->getUserProvider()];
        $userProvider = $userProviderFactory->create($rule->getProviderSettings());

        try {
            /** @var UserInterface $userFromProvider */
            $userFromProvider = $userProvider->loadUserByUsername($token->getUsername());
        } catch (UserNotFoundException $e) {
            $userFromProvider = null;
        }

        if ($userFromProvider === null ) {
            $this->error = 'auth.user.not.found';
            return false;
        }

        $password = $userFromProvider->getPassword();

        if (password_verify($token->getPassword(), $password)) {
            $this->userStorage->setUserState($userFromProvider);
            return true;
        }

        $this->lastUsername = $token->getUsername();
        $this->error = 'auth.invalid.password';
        return false;
    }


    public function updateUserFromStorage()
    {

        $user = $this->getUserStorage()->getUser();
        $id = $user->getId();

        $rule = $this->authenticationRules[$this->getCurrentAuthRuleName()];
        $userProviderFactory = $this->userProviderFactories[$rule->getUserProvider()];
        $userProvider = $userProviderFactory->create($rule->getProviderSettings());


        $data = $userProvider->loadUserById($id);

        $this->getUserStorage()->setUserState($data);

    }

    /**
     * Logout user and removes storage keys.
     */
    public function logout()
    {
        $this->getUserStorage()->removeUserFromStorage();
    }

    /**
     * @return UserStorage
     */
    public function getUserStorage(): UserStorage
    {
        return $this->userStorage;
    }

    /**
     * @param UserStorage $userStorage
     * @return AuthenticationManager
     */
    public function setUserStorage(UserStorage $userStorage): AuthenticationManager
    {
        $this->userStorage = $userStorage;
        return $this;
    }


    /**
     * @deprecated
     * @param UserProviderInterface $provider
     * @param string $name
     * @return AuthenticationManager
     */
    public function addProvider(UserProviderInterface $provider, $name)
    {
        $this->userProviders[$name] = $provider;

        return $this;
    }

    /**
     * @deprecated
     * @return UserProviderInterface[]
     */
    public function getUserProviders(): array
    {
        return $this->userProviders;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return AuthenticationManager
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastUsername()
    {
        return $this->lastUsername;
    }

    /**
     * @param string $lastUsername
     * @return AuthenticationManager
     */
    public function setLastUsername($lastUsername)
    {
        $this->lastUsername = $lastUsername;
        return $this;
    }

    public function addAuthenticationRule(AuthenticationRule $rule)
    {
        $this->authenticationRules[$rule->getName()] = $rule;

        return $this;
    }

    /**
     * @param $name
     * @return AuthenticationRule|null
     */
    public function getAuthenticationRuleByName($name)
    {
        return $this->authenticationRules[$name] ?? null;
    }

    /**
     * @return AuthenticationRule[]
     */
    public function getAuthenticationRules(): array
    {
        return $this->authenticationRules;
    }

    /**
     * @param AuthenticationRule[] $authenticationRules
     * @return AuthenticationManager
     */
    public function setAuthenticationRules(array $authenticationRules): AuthenticationManager
    {
        $this->authenticationRules = $authenticationRules;
        return $this;
    }

    /**
     * @return FirewallRule|null
     */
    public function getFirewallRule()
    {
        return $this->firewallRule;
    }

    /**
     * @param FirewallRule|null $firewallRule
     * @return AuthenticationManager
     */
    public function setFirewallRule($firewallRule): AuthenticationManager
    {
        $this->firewallRule = $firewallRule;
        return $this;
    }

    /**
     * @return AuthenticationRule
     */
    public function getDefaultRule(): AuthenticationRule
    {
        return $this->defaultRule;
    }

    /**
     * @param AuthenticationRule $defaultRule
     * @return AuthenticationManager
     */
    public function setDefaultRule(AuthenticationRule $defaultRule): AuthenticationManager
    {
        $this->defaultRule = $defaultRule;
        return $this;
    }

    /**
     * @param string $name
     * @return ExtractorInterface
     */
    public function getExtractor($name)
    {
        return $this->extractors[$name];
    }

    /**
     * @return ExtractorInterface[]
     */
    public function getExtractors(): array
    {
        return $this->extractors;
    }

    /**
     * @param ExtractorInterface[] $extractors
     * @return AuthenticationManager
     */
    public function setExtractors(array $extractors): AuthenticationManager
    {
        $this->extractors = $extractors;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentAuthRuleName(): string
    {
        return $this->currentAuthRuleName;
    }

    /**
     * @param string $currentAuthRuleName
     * @return AuthenticationManager
     */
    public function setCurrentAuthRuleName(string $currentAuthRuleName): AuthenticationManager
    {
        $this->currentAuthRuleName = $currentAuthRuleName;
        $this->userStorage->setCurrentAuthRuleName($currentAuthRuleName);
        return $this;
    }

    /**
     * @return UserProviderFactoryInterface[]
     */
    public function getUserProviderFactories(): array
    {
        return $this->userProviderFactories;
    }

    /**
     * @param UserProviderFactoryInterface[] $userProviderFactories
     * @return AuthenticationManager
     */
    public function setUserProviderFactories(array $userProviderFactories): AuthenticationManager
    {
        $this->userProviderFactories = $userProviderFactories;
        return $this;
    }

    public function addUserProviderFactory($name, UserProviderFactoryInterface $factory)
    {
        $this->userProviderFactories[$name] = $factory;

        return $this;
    }
}