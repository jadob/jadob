# jadob/jadob


## Introduction

Jadob is a PHP7 application framework, based on Symfony and Zend Framework components. It comes with the most important
stuff needed to start developing your PHP project.
Jadob uses Twig for templating and Doctrine ORM/DBAL/ODM for SQL and MongoDB databases support.


## Requirements

- PHP 7.3 or higher
 

## Tests

Jadob uses PHPUnit and Phan to test the whole codebase. 

``php-ast`` extension would be useful. 

Enabling test suite:

``vendor/bin/phpunit``

## Experimental Features

There are some "hidden" features which can be enabled by setting  ``JADOB_ENABLE_EXPERIMENTAL_FEATURES`` env to ``1``.
These ones might break or be unstable, so you can use it at production servers at your own risk.

Features can be unmarked as experimental when it will be unit-tested and considered stable.
 

## Things that need to be done before `1.0.0` release
* [x]  30%+ Code Coverage
* [x]  40%+ Code Coverage
* [ ]  50%+ Code Coverage
* [ ]  60%+ Code Coverage
* [ ]  70%+ Code Coverage
* [ ]  80%+ Code Coverage
* [ ]  90%+ Code Coverage
* [ ]  95%+ Code Coverage
* [ ]  CRAP Index >= 10 for all methods
* [ ] `Jadob\Core`
* [ ] `Jadob\Security`
* [ ] `Jadob\Saml`
* [ ] `Jadob\Oauth`
* [ ] `Jadob\Router`
* [ ] Better Error Handling
* [ ] Documentation
* [ ] Default Event Listeners should be moved from `Jadob\EventListener` to `Jadob\Core`, because they are framework-specific stuff.
* [ ] Service Providers Should be moved to `Jadob\Core` too.
* [ ] All Bridges (`Jadob\DoctrineORMBridge`, `Jadob\SymfonyFormBridge`) should be moved do `Jadob\Bridge\*` namespace.

## Getting Started

@TODO

## License 

MIT


