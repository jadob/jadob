# jadob/router

## Routing component for Jadob Framework


### Getting Started


```php
//Creating and configuring router instance:


//defining routes:
$routes = [
    'home' => [
        'path' => '/', //required
        'controller' => 'Your/App/Controller::class, //required
        'action' => 'index' //not required
        'ignore_global_prefix' => true //if true, 
    ],
];


//if you need to add a set of routes with a common prefix:
$collection = new \Jadob\Router\RouteCollection();
$collection->setPrefix('/backend');


// this route will be matched on URI "/backend/posts/new"
$backendRoute = (new Route('backend_new_post'))
    ->setPath('/posts/new')
    ->setController(\Your\App\BackendController::class)
    ->setAction('newPost');



$collection->addRoute($backendRoute);

//when collection is passed to array, his key is ignored
$routes['backend_collection']  = $collection;


$routerConfig = [
    'routes' => $routes
];


$router = new \Jadob\Router\Router($routerConfig);





````





### Changelog

- 0.70.1 - ``locale_prefix`` renamed to ``global_prefix``.