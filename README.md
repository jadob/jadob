# jadob/jadob

![Packagist](https://img.shields.io/packagist/l/jadob/jadob.svg)

## DISCLAIMER

There is no production-ready version at this time. Use at your own risk.

## Introduction

Jadob is a PHP7 application framework, based on Symfony components. It comes with the most important
stuff needed to start developing your PHP project.
Jadob uses Twig for templating and Doctrine ORM/DBAL/ODM for SQL and MongoDB databases support.


## Requirements

- PHP 7.4.0 or higher

 
## Things that need to be done before `1.0.0` release

### Default things

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
* [ ] All Bridges (`Jadob\DoctrineORMBridge`, `Jadob\SymfonyFormBridge`) should be moved do `Jadob\Bridge\*` namespace.
* [ ] Custom CSRF Extension to Forms 
* [ ] 

### URL

* [ ] Immutable Url object
 
### Config

* [ ] Support for YAML files

### EventSourcing

* [ ] Generating events and testcases classes from php/yaml config 

## Container
- aliasing
- config via arrays


## Testing

Jadob uses PHPUnit for unit test, Psalm for static analysis and Infection for Mutation testing.


## Getting Started

@TODO

## License 

MIT


