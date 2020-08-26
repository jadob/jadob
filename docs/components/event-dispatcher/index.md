# jadob/event-dispatcher

PSR-14 Compliant Event dispatcher.

## Instantiating Dispatcher object:

```php
<?php
$logger = getPSR3LoggerOrNull();
$eventDispatcher = new \Jadob\EventDispatcher\EventDispatcher($logger);
```


## Adding listeners 
Each listener must implement `Psr\EventDispatcher\ListenerProviderInterface` interface.
```php
$listener = getPSR14CompliantEventListener();
$eventDispatcher->addListener($listener);
```

## Dispatching an event
Each event must be an `object`.
```php
$event = new MyEventClass();
$eventDispatcher->dispatch($listener);
```
Also, `Psr\EventDispatcher\StoppableEventInterface` is respected here, so if event implements this interface and 
`isPropagationStopped` will return true, event dispatching will stop, no further listeners would be invoked.


## Affecting listener provider invocation order

By default, each listener provider has a priority of `100` and all of them are invoked in order as they are added to dispatcher.
If you want to execute listeners from given provider earlier or later than rest of them, your class must implement
`Jadob\EventDispatcher\ListenerProviderPriorityInterface` interface, and in `getListenerPriorityForEvent`
method you must return a  non-negative integer which will define priority of given listener. Event passed to `dispatch` method would
be passed as a first argument. `getListenersForEvent()` would be called before, if they will be no listeners for given object,
further priority resolving will be aborted.

```php

class EventProvider implements \Jadob\EventDispatcher\ListenerProviderPriorityInterface {

    public function getListenerPriorityForEvent(object $event) {
        if($event instanceof UserBannedEvent) {
            return 10;
        }       
        
        return 12;
    }   
}
```