# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.0.64]
### Added 
- Bumped vendors versions
- Added ``EventSourcing`` Component
- [Container] Added ``Container#autowire()`` method
- [Container] Added ``LazyInvokableClass`` for invokables
- [Http] Added implementation for PSR HTTP-related interfaces

### Changed
- [Core] Dispatcher will now try to autowire classes in controller if there are not present in Container
- [Micro] Renamed from ``Application`` to ``Micro``, rewritten to comply with PSR Requests and Middlewares

### Fixed
- [Router] now iterates through all methods, and throws ``MethodNotAllowedException`` only if no path supporting given method is found (9d90b200d)


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