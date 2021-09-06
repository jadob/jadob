# jadob/router

Provides URL Routing and generating. 

## Configuration Reference

### Config node name
`router`

### Config options
- `case_sensitive` - boolean 
- `force_https` - boolean - ignores `$_SERVER['HTTPS']` presence and forces router to generate all paths with HTTPS protocol.
- `routes` - Route[]|array - array of Routes and Route Collections.
- `context` - array - sets fixed context for router:
  - `host` - string - hostname of your webpage.
  - `port` - int - port number
  - `base_url` - string - full base URL where your page lives. *(Overrides values from `host` and `port` options)*

When `context` is passed to config, values from superglobals are ignored.
  
#### `routes` key syntax:
You can pass here a `Route[]` directly, or pass an array with syntax as below:

Each route should have their name as a array-key, and their props in array-value:
````
[
    'app_redirect' => [
        'path' => '/',
        'controller' => \App\Controller\IndexController::class,
        'action' => 'index',
        'methods' => ['GET'],
        'params' => [],
        'host' => 'example.com'
    ],
    // ...
]
````

Where:
- `path` defines an resource URI *(Required)*;
- `controller` defines a FQCN of controller class *(Required)*;
- `action` defines a method to call;
- `methods` is an `string[]` of HTTP Methods given route supports (when not given, any method will be matched);
- `params` is an array of parameters that would be passed to further execution; they can be used e.g in some listeners etc.;
- `host` is a hostname which should be matched to access this route;
  
Only `path` and `controller` are required, `action` defaults to `__invoke` when not passed.

It's also possible to define a route collection by using this syntax:

````
'app_with_locale' => [
        'prefix' => '/{_locale}',
        'host' => 'example.com',
        'routes' => [
            
        ]
    ]
````
Where:
- `prefix` defines a common prefix for all routes in collection *(Required)*;
- `routes` defines an array of routes *(Required)*;
- `host` defines a common host for all of routes in this collection.

In this case, array-key has a symbolic meaning and would be ignored.


## Creating an instance of Router:

Following example will create a `Router` instance will all values taken from superglobals:
````
$context = Context::fromGlobals();
$routeCollection = new RouteCollection();

$router = new Router($routeCollection, $context);
````

### Setting a base hostname:

Use `Context::fromBaseUrl()`:

````
$context = Context::fromBaseUrl('https://example.com');
$routeCollection = new RouteCollection();

$router = new Router($routeCollection, $context);
````

In this case, superglobals will be ignored and router will create all URLs with HTTPS and `example.com` as a host by default.

### Setting an alias:
You can use `Context::fromBaseUrl()` and path will be used as an alias:
````
$context = Context::fromBaseUrl('https://example.com/_api');
$routeCollection = new RouteCollection();

$router = new Router($routeCollection, $context);
````

Or set them manually by using `Context#setAlias()`:

````
$context = Context::fromBaseUrl('https://example.com');
$context->setAlias('/_api');
$routeCollection = new RouteCollection();

$router = new Router($routeCollection, $context);
````




