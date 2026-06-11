# Authentication

`jadob/auth` is a component responsible for handling authentication. With that component you can handle both
login forms for your user, API authentication and more.

## Getting started:

- Add `Jadob\Auth\Module\AuthenticationModule` to modules list in your bootstrap file:

````php
class Bootstrap implements \Jadob\Core\BootstrapInterface {

    public function getModules() : array{
        return [
            \Jadob\Auth\Module\AuthenticationModule::class
        ];
    }
}
````

- Create `authentication` config node:

```php
// config/authentication.php
use Jadob\Auth\ServiceProvider\AuthenticationConfig;

return static function (AuthenticationConfig $authConfig): AuthenticationConfig {
    return $authConfig;
};
```

- And now you are ready to build authentication for your application.

## Authentication components

### `Firewall`

Firewall is a set of authenticators which protects particular part of the app (for example API, or admin panel). You 
can have as many as you need. Each firewall can have dedicated behaviors enabled to support your use-case, such as 
stateless (for API) or identity stacking (for having more than one identity being authenticated within one session).

### `Authenticator`

Authenticator, as the name suggests, handles authentication. Each Firewall can have many authenticators which allows to
support multiple authentication ways in one firewall (e.g one for LDAP, one for login form) or handle MFA (each authenticator
handle one factor). 

### `Request Matcher`

Decides whether given firewall should support given request. 

### `Identity Provider`

Service that receives an identity ID from Authenticator and turns it into a Identity Object (such as user, or API Client)
- either by fetching it from persistence or in-memory storage.

### `Identity Picker`

Used only with Identity Stacking enabled. Determines which currently authenticated Identity should be used in given request.

## Creating a firewall

- Start with creating Request Matcher object.

```php
<?php

namespace App\Security\Auth;

use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminPanelRequestMatcher implements RequestMatcherInterface 
{
    /**
     * @param Request $request
     * @return bool
     */
    public function matches(\Symfony\Component\HttpFoundation\Request $request) : bool 
    {
       return str_starts_with('/admin', $request->getPathInfo());
    }
}
```

- Create your Authenticator service:

```php
<?php

namespace App\Security\Auth;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;

class AdminPanelAuthenticator implements AuthenticatorInterface 
{
    
    // This method is called first to determine if this authenticator should process the request. 
    public function supports(Request $request) : bool
    {
        return $request->isMethod('POST')
            && $request->getPathInfo() === '/admin/login'      
    }
    
    
    // This is where the all magic happens. if supports() return true, this method is invoked.
    public function authenticate(Request $request) : AccessToken 
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
       
        try {
            $user = $this->userRepository->getByEmail($email);
           
            if(password_verify($password, $user->password) === false) {
                throw new InvalidPasswordException();
            }
           
            // Do not return the user object, return an AccessToken with identity id and metadata:
            return new AccessToken(
                // This will later be used to fetch identity from IdentityProvider.
                identityId: $user->id,
                
                // You can attach something to be stored in session - for example organization id for identity stacking.
                metadata: [
                    'org_id' => $user->organizationId
                ];
            )
        } catch (UserNotFoundException|InvalidPasswordException) {
            // Throw Jadob\Contracts\Auth\AuthenticationException if something was wrong to immediately abort. 
            throw new AuthenticationException('Invalid email or password');
        }
    }
}
```


## Identity stacking

Identity stacking allows you to have multiple identities authenticated at the same time within the same session. By using
this feature, you can create multiple-account support similar to the ones used in e.g email services (like gmail or outlook).
Stacking cannot be used in stateless firewalls.



