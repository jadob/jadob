# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.0.63] - Release TBA
### Changed
- [DoctrineORMBridge] Replaced ArrayCache with FilesystemCache
- [Guard] component has been deprecated, use [Supervisor] instead
- [TwigBridge] PathExtension and DebugExtension has been moved to ``Jadob\Bridge\Twig`` namespace.

### Added
- Added [Supervisor] Component

### Removed
- [TwigBridge] AssetExtension has been removed.
- Dropped ``Jadob\TwigBridge`` namespace.

## [0.0.61] - 2019-04-26

### Added
- [Guard] Added excluded paths feature - you can now exclude some routes from being secured
- [Core] Added AbstractController which can be used as an base controller in your app. It contains "shortcuts" to some frequently used features like twig, request or form factory.