# Jadob development guidelines

## Warning section

This document applies only to `jadob/jadob` development.

## Release process

### 1. Bump framework version

These places must be modified while bumping version:
- `Jadob\Core\Kernel::VERSION`

### 2. Update `CHANGELOG.md` in project root

This file follows the [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) format.

Add each contribution in `[Unreleased]` section on the top of the file, prefixed with component name in square brackets, and followed with links to issues/PRs. 

### 3. Separate new version in `CHANGELOG.md`

- Replace `[Unreleased]` with `[VERSION]`, then add a date in `YYYY-MM-DD` format.

### 4. Push changes to GitHub and make a GitHub Release

In release description paste the contents of given version from `CHANGELOG.md`.

### 5. ...and its done!

Release invokes a bunch of scripts responsible for splitting components, pushing them to read-only
repos and updating packagist information. That will take a minute or two.

## New package checklist:
- Package is MIT-licensed
- Package has its own 1composer.json 1file
- `rdepcheck` does not show any errors related with new package
- If package has some "specific" files that should not be tested, then these files are defined in phpunit/psalm excludes
- Package does not rely on `jadob/core` 
