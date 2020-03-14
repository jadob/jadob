# Parent Providers

Your Service Provider can have parents. Parent is a provider that is registered **before** registering a current service 
provider. Using Parents is great way to define which provider is required for current one.


Please note: There is no need to define parent providers in your ``Bootstrap`` class. 


## Example 1

There ``BProvider`` and ``AProvider``. ``BProvider`` relies on some classes registered by ``BProvider``.  In this case
BProvider should implement ``Jadob\Container\ServiceProvider\ParentProviderInterface`` and define ``AProvider`` as a parent:

````
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

If some other providers will also require ``AProvider`` as a parent, these invocation will be ignored as these class
has been registered and it will continue service registering.






