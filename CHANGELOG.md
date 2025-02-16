# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Removed
- removed `symfony/http-kernel`, `symfony/dependency-injection` and `rector/rector` from dev deps

## [0.4.23] - 2025-02-16
### Removed
-  Detached `doctrine/annotations` bridge

## [0.4.22] - 2025-02-16

### Deprecated
- Deprecated `doctrine/annotations` bridge

### Removed
- [Objectable] removed unused deps


## [0.4.21] - 2025-02-16
### Added
- [Objectable] custom item processing via `ItemTransformerInterface`
- [Router] add `RouteMatcher`

### Changed
- `vimeo/psalm` has been removed from the core `composer.json` and moved to tools
- `phpunit/phpunit` has been removed from the core `composer.json` and moved to tools

### Fixed
- [Authenticator] identity is not refreshed when is not present

### Removed
- [Objectable] deleted obsolete files and classes
- Removed obsolete PSR7 compliance feature

## [0.4.20] - 2025-01-04
### Added
- Added identity refreshing feature
- [DoctrineDBALBridge] added `mapping_types`

### Changed
- Deprecated `UserProviderInterface`
- [Objectable] `ItemProcessor` stopped using `doctrine/annotations` and `symfony/property-access`

### Removed
- Removed username and password from user interface

## [0.4.19] - 2024-12-14

### Changed
- Bumped package versions

## [0.4.18] - 2024-08-17

### Changed
- Applied CS Fixes

### Fixed
- [Container] `has()` will now return true if service is present, but not instantiated yet

## [0.4.17] - 2024-07-31

### Fixed
- [Aggregate] added autoload in `composer.json`
- [EventStore] added autoload in `composer.json`

## [0.4.16] - 2024-07-31

### Changed
- [Docs] Merged framework related development docs into one file
- Removed `BeforeControllerEvent` in favor of `RequestEvent`
- `jadob/aggregate` and `jadob/event-store` was extracted from `jadob/event-sourcing`
- `jadob/container` went through first refactor
- Deprecated `jadob/dashboard`
### Removed
- PSR-7 Compliance 
- Removed `Supervisor` component in favor of `Authenticator`



## [0.4.15] - 2023-03-26
### Fixed
- [BridgeSymfonyConsole] added `symfony/console` to `composer.json`

## [0.4.14] - 2022-11-14
### Changed
- [Objectable] added support for `doctrine/collections`
- [Dashboard] added `form_transform_hook`


## [0.4.13] - 2022-10-24
### Changed
- [Objectable] deprecated `order` property in `Field`
### Fixed
- Added missing return type in service providers with parent providers

## [0.4.12] - 2022-10-14
### Changed
- [Forms] Forms Provider requires a TwigProvider as a parent
### Fixed
- [Doctrine] Removed obsolete helperset class reference

## [0.4.11] - 2022-06-29
### Added
- [TypedGeo] added high precision coordinates with valid doctrine mapping
### Fixed
- [Objectable] return `null` when no object would be passed while flat object serialization

## [0.4.10] - 2022-06-17
### Added
- `dynamite/dynamite` Service Provider has been transferred here
- [Dashboard] Added pagination
- [Objectable] extract datetime with user-given format

## [0.4.9] - 2022-03-11
### Fixed
- [Router] SERVER_PORT is typecasted in Router Context

## [0.4.8] - 2022-02-22
### Added
- more types for typed-telegram
- security-supervisor i security-auth now can be used as a standalone package

### Fixed
- [Router] Context does not return exceptions while in CLI mode

### Changed
- [Webhook/Provider/Telegram] TelegramEventExtractor will not accept malformed JSON
- Downgraded doctrine/cache
- Bumped infection/infection
- [Objectable] Field has now `default` context as a default context

### Removed
- [Objectable] dropped obsolete files

## [0.4.7] - 2022-02-22
### Removed
- [Bridge/Doctrine/DBAL] Removed HelperSet in favor of SingleConnectionProvider

## [0.4.6] - 2022-02-21
### Changed
- Console integration finally got its own home in Jadob/Bridge namespace
### Removed
- Removed pagerfanta integration (not maintained for a long time)

## [0.4.5] - 2022-02-18
### Fixed
- [Objectable] ItemProcessor makes property accessible before getting value

## [0.4.4] - 2022-02-17
### Added
- [Dashboard] Showing single object from persistence
- [WebhookHandler] added Symfony Bundle
- [WebhookHandler] more telegram types

## [0.4.3] - 2022-02-13
### Added
- [Dashboard] new contracts 

### Changed
- [Objectable] bumped vendors

## [0.4.2] - 2022-02-10
### Added
- First packages are now fully split and ready to be used instead of installing the whole `jadob/jadob` dep

## [0.4.1] - 2022-02-06
## Fixed
- [webhook-provider-telegram] fixed namespaces in composer.json

## [0.4.0] - 2022-02-06
### Added
- New `jadob/webhook-handler` stub
- New `jadob/webhook-provider-telegram` stub
- New `jadob/contracts-webhook` stub
- New `jadob/objectable` component (or to be honest, imported old project and attempting to fit them here)
- More Telegram types
- Added PHP-CS-Fixer processing

### Changed
- Almost any file was processed by php-cs-fixer

### Removed
- Support for PHP7 has been dropped.

## [0.3.0] - 2022-01-07
### Added
- Added `jadob/typed-geo` component
- Added `jadob/typed-telegram` component
### Changed
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
