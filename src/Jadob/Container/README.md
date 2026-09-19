# jadob/container

Dependency Injection Container. [PSR-11](https://www.php-fig.org/psr/psr-11/) Compatible.

## Running tests

Please run test in ``jadob/jadob`` repository, not in this one.

## Whats new?

The whole container creation process have been now split into three parts:

### `ContainerBuilder`

Collects all dependencies, service providers, parameters into one place.

### `ContainerCompiler`

Resolves service providers, service definitions and references 

### `Container`

Basically read only instance, knows only about services and parameters that have been compiled.

## Wiring up a container

```php

$builder = new \Jadob\Container\Builder\ContainerBuilder();


$compiler = new \Jadob\Container\Compiler\ContainerCompiler();
$compiler->


```

## License

MIT


