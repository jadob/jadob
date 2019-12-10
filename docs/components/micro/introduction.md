# jadob/micro

This is normal Jadob, but smaller and with more PSRs support out of the box.

Micro can be used for building small applications APIs instead of using default ``Jadob\Core\Kernel`` kernel class.
These two kernels utilise the same codebase so you can e.g. use the same ServiceProviders in both of them. 

``jadob/micro`` complies with more PSRs than default Jadob Kernel:
- ``PSR-3`` Logging (available via ``$micro->getLogger()``)
- ``PSR-7`` Messaging
- ``PSR-11`` Container (available via ``$micro->getContainer()``)
- ``PSR-15``
- ``PSR-17``

Please note that ``micro`` is built with more interoperability in mind. Some PSRs probably
will never be implemented in Core Kernel.


## What features are missing in Micro?
- Path generator - You have to write your URLs manually


## ``psr/http-message`` vs ``symfony/http-foundation``
When using default dependency injection, you can autowire **both** of them in your controllers as Micro can create HttpFoundation from 
PSR7 Request Interface. 

```php
<?php

use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
$micro = new \Jadob\Micro\Micro();

//This will work
$micro->get('/path', function(RequestInterface $request) { /**...**/ });

//This will work too
$micro->get('/path', function(Request $request) { /**...**/ });

//... even this one
$micro->get('/path', function(Request $request, RequestInterface $request2) { /**...**/ });

```

Remember that conversion is done after going through all middlewares to comply with PSR-15, before controller resolving:

````
Middleware1 (PSR)
- Middleware2 (PSR)
- - Middleware3 (PSR)
- - - DispatcherMiddleware (PSR, Symfony)
- - - - Your Controller (PSR, Symfony)
- - - DispatcherMiddleware (PSR, Symfony is converted to PSR)
- - Middleware3 (PSR)
- Middleware2 (PSR)
Middleware1 (PSR)
````

The same thing applies to Responses. You can return both types of responses, they will be converted to PSR Response, passed through middlewares and emitted.

