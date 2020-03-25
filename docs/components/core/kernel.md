# Kernel Class

Turns requests into responses. 

## PSR-7 Complaint 
Jadob is able to handle psr-7 based controllers in your application. When enabled, HttpFoundation object is converted to PSR-7 
and passed to your action. Dispatcher will automatically detect which request object should be used for further execution.

** Note that this applies only to controller methods so far. **

### Enable/Disable feature

Before ``Kernel->execute()`` invocation, call ``Kernel->setPsr7Complaint()`` method:

```php
//in your index.php file

$kernel = new \Jadob\Core\Kernel();

var_dump($kernel->isPsr7Complaint()); //false by default
$kernel->setPsr7Complaint(true); //set false to disable

$response = $kernel->execute(); //HttpComponent Response returned
```

### Overriding Default converter
Under the hood, a ``symfony/psr-http-message-bridge`` and ``nyholm/psr7`` are used for converting Symfony Request object into
a PSR-7 Request. You can override it with your own solution by providing a Closure into ``framework.dispatcher.psr7_converter``config key:

```php
//config/framework.php

return [
    'dispatcher' => [
        'psr7_converter' => static function (Request $request) {
            return convertRequest($request);
        }
    ]   
]



```