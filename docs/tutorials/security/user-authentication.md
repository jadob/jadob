
# How to handle user authentication  
  
  By default, Jadob does not require any authentication out-of-the-box. When creating new project you need to 
  implement your own authentication system by using ``Jadob\Security`` components.
  
##  Register SupervisorProvider in your Bootstrap file  
``Jadob\Security\Supervisor\ServiceProvider\SupervisorProvider``   adds to Container a ``Supervisor`` 
class which will be responsible for managing all your ``RequestSupervisor`` objects.  You can have as many request supervisor as many authentication systems you need. 


**Add new service provider to your Bootstrap file:**
````diff  
<?php  
  
+ use Jadob\Security\Supervisor\ServiceProvider\SupervisorProvider;  
  
class Bootstrap implements BootstrapInterface {  
	public function getServiceProviders() { 
		 return [
+           SupervisorProvider::class              
        ]  
 }  
}  
````

## Create Request Supervisor

Request supervisor decides that current request requires authentication, and handles them if needed.
You should have one supervisor per "endpoint", that means:

- When you only allow your users to be logged in, you need to create **1** supervisor;
- When you expose some API for your users, you need to create **2** supervisors (one for users, second for API).


Your supervisor class **MUST**  implement ``Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface``.


**Create new RequestSupervisor:**

````php
<?php

namespace App\Security\RequestSupervisor;

use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Jadob\Security\Auth\User\UserInterface;  
use Jadob\Security\Auth\UserProviderInterface;  
use Symfony\Component\HttpFoundation\Request;  
use Symfony\Component\HttpFoundation\Response;

class UserRequestSupervisor implements RequestSupervisorInterface {
	
	//DO NOT VERIFY CLIENT CREDENTIALS HERE.
	//Decides that given request should be managed by this supervisor, 
	//but allows user to be unauthenticated
	public function isAnonymousRequestAllowed(Request $request): bool 
	{
		
	}
	
	//when true returned, authenticated client will not be stored in session 
	//and will be removed at the end of the request.
	public function isStateless(): bool 
	{
		
	}
	
	//DO NOT VERIFY CLIENT CREDENTIALS HERE.
	//Allows to check that given request is an authentication attempt.
	//That means you have to check all requirements (path, method, body etc.) 
	//are passed to request. 
	//called ONLY when isStateless() returns false.
	public function isAuthenticationRequest(Request $request): bool
	{
		
	}
	
	//DO NOT VERIFY CLIENT CREDENTIALS HERE.
	//basically, you have to extract credentials here. 
	//called after isAuthenticationRequest when not stateless.
	//called every request when stateless. 
	//As there is no return type defined in interface, you can return everything,
	//and this value will be passed later to other methods.
    public function extractCredentialsFromRequest(Request $request) 
    {
	    
    }

	//DO NOT VERIFY CLIENT CREDENTIALS HERE AS THERE IS TOO LATE.
	//called when authentication succeeds. 
	//return null to continue request, return Response e.g. to redirect to another page.
	public function handleAuthenticationSuccess(Request $request, UserInterface $user): ?Response 
	{
	
	}
	
	//DO NOT VERIFY CLIENT CREDENTIALS HERE AS THERE IS TOO LATE.
	//called when something goes bad.
	//returned response will be sent to client.
	public function handleAuthenticationFailure(): Response
	{
	
	}
	
	//DO NOT VERIFY CLIENT CREDENTIALS HERE.
	//there will be a return value from your extractCredentialsFromRequest method here in $credentials. 
	//use them to get your client from provider.
	//return null to throw UserNotFound automatically,
	//or throw UserNotFound (or e.g your instanceof them) by yourself when you need to pass more
	//information to handleAuthenticationFailure method.
	public function getIdentityFromProvider($credentials, UserProviderInterface $userProvider): ?UserInterface 
	{
	
	}

	//NOW IS THE TIME, HERE IS THE PLACE!
	//VERIFY YOUR CLIENT IDENTITY HERE!
	//return true when credentials match, return false when not.
	public function verifyIdentity(UserInterface $user, $credentials): bool 
	{
		
	}
	
	//DO NOT VERIFY CLIENT CREDENTIALS HERE.
	//Check here that given request should be supported by this supervisor.
	public function supports(Request $request): bool 
	{
	
	}
}
````

