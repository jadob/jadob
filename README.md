# jadob/jadob

![Packagist](https://img.shields.io/packagist/l/jadob/jadob.svg)

## DISCLAIMER

There is no production-ready version at this time. Use at your own risk.

## Introduction

Jadob is a PHP7 application framework, based on Symfony and Zend Framework components. It comes with the most important
stuff needed to start developing your PHP project.
Jadob uses Twig for templating and Doctrine ORM/DBAL/ODM for SQL and MongoDB databases support.


## Requirements

- PHP 7.3 or higher
 
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
* [ ] Custom CSRF Extension to Forms 



## Testing

Jadob uses PHPUnit for unit test, Phan for static analysis and PHP_CodeSniffer with Doctrine standard 
for code standards maintaining. There is no framework-specified standards, the best practices from 
these three tools should apply. 

``php-ast`` extension and disabled XDebug would be useful as Phan without it is really slow.

Running full Testing suite:

``vendor/bin/phpunit``

``vendor/bin/phan``

``vendor/bin/phpcs --standard=Doctrine src``


## Getting Started

@TODO

## License 

MIT


