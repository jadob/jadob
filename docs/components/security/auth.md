# jadob/security

## How to login users in controller?

````php

class ExampleController {
    
    public function __construct(
        /**
         * Inject this service
         */
        private \Jadob\Security\Auth\AuthenticatorService $authenticatorService
    ) {
    }
    
    public function exampleMethod(
        \Symfony\Component\HttpFoundation\Request $request,
        
    ) {
        $user = /* do stuff to get your user object */;
        
        $this
            ->authenticatorService
            ->storeIdentity(
                $user,
                $request->getSession(), // required in stateful request, but session is not started in stateless requests
                'authenticator_name'    // key from config/authenticator.php
            );
    }

}



````


