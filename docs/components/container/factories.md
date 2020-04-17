# Factories

When your service relies on some third-party classes, you can define them as a *factory*.

## Creating factory in services.php

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

**Factories are resolved once, when requested via get() or autowiring.** Until the request terminates, a returned object 
from factory will be used with each service request.

## Factory return type optimization

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

This will make that factory will be **skipped** when return type does not implement/extend given interface or class.

### Why Container is looking for return type, instead of service key/name?

Service name may contain characters that does not match to class FQCN (dots, numbers etc.). There is no restriction that 
requires you to use FQCN as your service name so you can name your service as you only want: 

````php
//config/services.pgp
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
