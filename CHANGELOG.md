# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased
- [AwsBridge] - in progress
- [Serverless] - support for AWS Lambda in progress
- [Webhook] - in progress
- [Core] Deferred logger

## [0.0.67]
### Added
- [Router] Partial support for aliased paths
### Changed
- [Core] RouterServiceProvider is added in Kernel as a core provider
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
