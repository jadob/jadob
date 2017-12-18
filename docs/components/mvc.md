# Slice/MVC

## 1. Introduction

Slice\MVC is used to defining your controllers, models and views. 


## 2. Best practices

TBD

## 3. Defining your controller

Your controller can extend `Slice\MVC\Controller\AbstractController`, but it should 
return `Symfony\Component\HttpFoundation\Response`, otherwise exception will be raised.
Method names should have "Action" suffix e.g. indexAction, offerAction.

Example Controller:

```php

<?php
 
 namespace Acme\Application\Controller;
 
 use Slice\MVC\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;

 class HomeController extends AbstractController
 {
    public function indexAction() {
        
        return new Response('hello');
    }        
 }
 
 
````

TBD

