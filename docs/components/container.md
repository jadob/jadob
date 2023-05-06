# `jadob/container` overview

## Getting started

@TODO

## Service provider

@TODO

### Parent Providers

Your Service Provider can have parents. Parent is a provider that is registered **before** registering a current service
provider. Using Parents is great way to define which provider is required for current one.


Please note: There is no need to define parent providers in your ``Bootstrap`` class.


#### Example 1

There ``BProvider`` and ``AProvider``. ``BProvider`` relies on some classes registered by ``BProvider``.  In this case
BProvider should implement ``Jadob\Container\ServiceProvider\ParentProviderInterface`` and define ``AProvider`` as a parent:

````php
<?php
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

class BProvider implements ServiceProviderInterface, ParentProviderInterface {

    public function getParentProviders()
    {
        return [AProvider::class];
    } 

    //rest of methods omitted for brevity
}

````

``ContainerBuilder`` will instantiate and register ``AProvider`` class first and then will register ``BProvider``.


## Parameters

### Adding new parameter

You can add/override parameters by using `Container#addParameter` method:

````
$container = getContainer();
$container->addParameter('mailer.reply-to-address', 'hello@example.com');
````

### Getting a value of a parameter:

Use `getParameter` method:
````php
$container = getContainer();
$container->getParameter('mailer.reply-to-address');
````

You can also inject a param to your services by using `#[InjectParam]` attribute:

````php
use Jadob\Contracts\Container\Attribute\InjectParam;

class MailerService {
    public function __construct(
        #[InjectParam('mailer.reply-to-address')] protected string $replyToAddress
    )
}
````

When there will be no parameter defined, an Exception will be thrown. Container also will do not attempt to type-cast a parameter.

## Factories

When your service relies on some third-party classes, you can define them as a *factory*.

### Creating a factory

Factory is a just a ``Closure`` instance with your service definition inside. You can add `\Psr\Container\ContainerInterface $container` as a first argument to get an access to
Container if you want to get some depedencies from them.

````php
//config/services.php

return [
    //service definition
    'service1' => new Service(),
    //factory definition
    'service2' => static function(\Psr\Container\ContainerInterface $container) {
        return new Service2(
            $container->get('service1')  // this works
        )
    }, 
    //factory definition with factory dependency
    'service3' => static function(\Psr\Container\ContainerInterface $container) {
        return new Service3(
            $container->get('service2') // this also works
        )
    }, 
]


````

**Factories are resolved once, when requested via `get()` or autowiring.** Until the request terminates, a returned object
from factory will be used with each service request.

### Factory return type optimization

Some methods from container (``autowire``, ``findObjectByClassName`` and ``getObjectsImplementing``) scans services and
instantiates factories them to find classes that they are looking to. That means there can be some performance impact when there is a lot
of factories defined on first scan. You can prevent it by adding a return type to your factory definition:

````php
//config/services.php
return [
    //BEFORE: no return type
    \Aws\Sdk::class => static function () {
        return new \Aws\Sdk([
          //....
        ]);
    }, 

    //AFTER: return type defined
    \Aws\Sdk::class => static function (): \Aws\Sdk {
        return new \Aws\Sdk([
          //....
        ]);
    },
````

This will make that factory will be **skipped** when return type does not implement/extend given 
interface or class with no negative impact on your app performance.

#### Why Container is looking for return type, instead of service key/name?

Service name may contain characters that does not match to class FQCN (dots, numbers etc.). There is no restriction that
requires you to use only FQCN as your service name, so you can name your service as you only want:

````php
//config/services.php
return [
    //Service name VALID, FQCN VALID, type search will be working here
    \Aws\Sdk::class => static function () {
        return new \Aws\Sdk([
          //....
        ]);
    }, 

    //Service name VALID, FQCN INVALID, type search will break here
    'aws.cross.account' => static function (): \Aws\Sdk {
        return new \Aws\Sdk([
          //....
        ]);
    },

    //Service name VALID, FQCN VALID, class does not exists, type search will break
    TotallyRandom\NameThatLooksLikeAClass\ButThatClassDoesNotExists => static function (): \Aws\Sdk {
        return new \Aws\Sdk([
          //....
        ]);
    },
````

