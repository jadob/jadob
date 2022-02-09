# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.4.1] - 2022-02-06
## Fixed
- [webhook-provider-telegram] fixed namespaces in composer.json

## [0.4.0] - 2022-02-06
## Added
- New `jadob/webhook-handler` stub
- New `jadob/webhook-provider-telegram` stub
- New `jadob/contracts-webhook` stub
- New `jadob/objectable` component (or to be honest, imported old project and attempting to fit them here)
- More Telegram types
- Added PHP-CS-Fixer processing

## Changed
- Almost any file was processed by php-cs-fixer

## Removed
- Support for PHP7 has been dropped.

## [0.3.0] - 2022-01-07
## Added
- Added `jadob/typed-geo` component
- Added `jadob/typed-telegram` component
## Changed
- new test directory structure

## [0.2.6] - 2021-12-23
### Fixed
- [Dashboard] do not show checkbox while showing criteria results

## [0.2.5] - 2021-12-22
### Fixed
- [Dashboard] fill form with data in both form creation methods

## [0.2.4] - 2021-12-13
### Added
- [Container] added support for parameter
- [Container] injecting parameters to services via `InjecParam` attribute
- [Dashboard] Registered more Twig extensions
- [Dashboard] Added `redirects`
- Adding parameters in configuration

### Changed
- bumped php version

## [0.2.3] - 2021-09-17
### Added
- [Typed] First types for AWS Lambda

## [0.2.2] - 2021-09-10
### Added
- [Core] Added `BootstrapInterface::getDefaultLogStream`
- [Router] Allow to set alias in `Context::fromBaseUrl`

## [0.2.1] - Unreleased
### Added
- [Supervisor] Authentication fail reasons are stored in request attributes
- [Core] User can now be injected directly to controller
### Changed
- [Dashboard] User is redirected to referer after batch operation
### Fixed
- [Supervisor] User is now added to RequestContext in stateless supervisors


## [0.2.0] - 2021-08-29
### Added
- [EventSourcing] added DynamoDB Event Store
- [EventSourcing] added EventStore Extensions
- [EventSourcing] added EventHashExtension
- [Dashboard] added Predefined Criteria
- [Dashboard] added Symfony Bridge


## [0.1.6] - 2021-03-05
### Added
- [TwigBridge] aliased assets extension
- Added Dashboard component
- Added DoctrineMigrationsBridge component
- Added DoctrinePersistenceBridge component
- Added experimental Runtime component  
- [Router] sticky route parameters
- [SymfonyFormBridge] Support for Symfony `EntityType` form field

### Changed
- [Router] router can now have commas

### Removed
- Removed Micro component

## [0.1.5] - 2021-02-03
### Fixed
- [Supervisor] `SupervisorListener` does not break when `RequestSupervisorInterface#extractCredentialsFromRequest` returns a string



## [0.1.4] - 2021-01-16
### Added
- [AwsBridge] Added `AssumeRoleSesMailer`
- [DoctrineAnnotationsBridge] added DoctrineAnnotationsProvider
- [Core] added `AbstractController#url` method
### Changed
- [Supervisor] [BC BREAK] `Supervisor` now requires a `LoggerInterface` in constructor 
### Fixed
- [AwsBridge] `RoleSessionName` now contains only alphanumeric random values and AWS SDK is not throwing exceptions



## [0.1.3] - 2020-12-04
### Added
- [Router] Nesting Route collections in array of routes
### Fixed
- Fixed some static analysis issues

## [0.1.2] - 2020-10-31
### Added
- [Router] add `force_https` option
- [Router] add `context.base_url` option
### Changed
- [Router] refreshed documentation
- Bumped Psalm version to make it running on php8

## [0.1.1] - 2020-10-24
### Changed
- [Security] [BC BREAK] Return value from RequestSupervisorInterface#handleAuthenticationFailure() can be null
### Fixed
- [Core][Container] Removed reflection-related deprecations which flooded the logs with warnings

## [0.1.0] - 2020-10-17
### Added
- [EventDispatcher] Allow to specify priority for given listeners
- [Core] Added RequestContext::getUser() method
### Changed
- [Security] [BC BREAK] Renamed `AuthStorage` to `IdentityStorage`
### Removed
- [Core] [BC BREAK] Removed AbstractController::getUser() method
### Fixed
- [Auth] build session storage key in the same way in both methods (fixed in #9802f458f6ff5723fc23ed65f3d200d25dd23b66)


## [0.0.67]
### Added
- [Router] Partial support for aliased paths
- [Router] Define router context parameters in config 
### Changed
- [Core] RouterServiceProvider is added in Kernel as a core provider
- Fixed Symfony components version constraints to use LTS (3.4, 4,4) and latest (5.0)
- Fixed Twig and Doctrine ORM version constraints 
### Deprecated
### Removed
### Fixed


## [0.0.66] - 2020-05-13
### Added
- [Core] Added support for PSR-7 Controllers
- [Core] Added ``RequestContext`` object
- [Core] Added ``StaticPageController``
- [SymfonyTranslationBridge] Added automatically loaded translation paths
- [Container] Autowiring
- [Container] Factory Return types optimization

### Changed
- Bumped vendors version
- ``Request`` object now contains current route data

### Removed
- [Debug] Removed ``ErrorLogger`` as it has not been touched since february 2019 
- [Core] Removed ``LocaleChangedEvent`` as it not has been implemented yet and is not required

### Fixed
- [Router] route parameters does not disappear after route matching #ca7bf0f1


## [0.0.64]
### Added 
- Bumped vendors versions
- Added ``EventSourcing`` Component
- [Container] Added ``Container#autowire()`` method
- [Container] Added ``LazyInvokableClass`` for invokables
- [Http] Added implementation for PSR HTTP-related interfaces
- [Container] Added ``ParentProviderInterface`` to allow parent providers registering
- Added Doctrine Migrations Bridge
- Bumped minimum required PHP version
- Added ``infection/infection`` for mutation testing
- Added ``Contract`` component
- [Core] added PSR-7 Complaint mode in Kernel
- [Core] request object is removed from container
- [TwigBridge] added ``asset_url`` twig function

### Changed
- [Core] Dispatcher will now try to autowire classes in controller if there are not present in Container
- [Micro] Renamed from ``Application`` to ``Micro``, rewritten to comply with PSR Requests and Middlewares
- [Core] added ``$env `` to ``BootstrapInterface#getServiceProviders()`` to register providers depending on environment
- [TwigBridge] Renamed ``TwigServiceProvider`` class to ``TwigProvider``

### Fixed
- [Router] now iterates through all methods, and throws ``MethodNotAllowedException`` only if no path supporting given method is found (commit 9d90b20)

### Removed
- Removed ``phan/phan`` and replaced it with ``vimeo/psalm`` instead
- Removed ``doctrine/coding-standard``

### Deprecated
- [SymfonyTranslationBridge] is now deprecated and refactored to ``Jadob\Bridge\Symfony\Translation`` namespace with contract support
## [0.0.63] 
### Changed
- [DoctrineORMBridge] Replaced ArrayCache with FilesystemCache
- [Guard] component has been deprecated, use [Supervisor] instead
- [TwigBridge] PathExtension and DebugExtension has been moved to ``Jadob\Bridge\Twig`` namespace.
- [SymfonyFormBridge] has been moved to ``Jadob\Bridge\Symfony\Form`` namespace.

### Added
- Added [Supervisor] Component

### Removed
- [TwigBridge] AssetExtension has been removed.
- Dropped ``Jadob\TwigBridge`` namespace.
- Dropped ``Jadob\SymfonyFormBridge`` namespace.

## [0.0.61] - 2019-04-26

### Added
- [Guard] Added excluded paths feature - you can now exclude some routes from being secured
- [Core] Added AbstractController which can be used as an base controller in your app. It contains "shortcuts" to some frequently used features like twig, request or form factory.
