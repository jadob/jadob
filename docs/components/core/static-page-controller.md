# Static Page Controller


When the only thing that your controller should do is to render a template, you can use 
`Jadob\Core\Controller\StaticPageController` class which do it for you. When using Static Page Controller, you can reduce
your codebase and focus on more important tasks.
 
*Static Page Controller does not omits any listeners, this controller acts as the normal one and it does not have any 
custom behaviour defined.*


## Create Static Page Controller

Create a generic route and use `\Jadob\Core\Controller\StaticPageController::class` in your `controller`.
In `params` key, provide the name of template to be rendered in `template_key`. 

Do not provide `action` key as this controller has only `__invoke` method, and this method is called automatically.
````php
//config/routes.php

return [
    'app_static_route' => [
        'path' => '/static/kittenz',
        'controller' => \Jadob\Core\Controller\StaticPageController::class,
        'params' => [
            'template_name' => 'kittenz.html.twig'
        ]
    ]
]
````

When there is no `template_name` passed, an exception will be thrown.
Static Page Controller extends `Jadob\Core\AbstractController` and `renderTemplate` is used for rendering templates.
