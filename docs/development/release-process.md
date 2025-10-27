# Releasing a new version

Releasing means estabilishing a version that is ready to be distributed and pushed to the world. This documents describes
all steps required in order to make such release to happen.

## Release process

### 1. Bump framework version

These places must be modified while bumping version:
- `Jadob\Core\Kernel::VERSION` constant

### 2. Update `CHANGELOG.md`

This file follows the [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) format.

Replace `[Unreleased]` with `[VERSION]`, then add a date in `YYYY-MM-DD` format. Take a dive through reported items in a release
is placed in the right category. When done, add new `[Unreleased]` section at the top of the list.

### 4. Push changes to GitHub and make a GitHub Release

Submit every release-related change in one commit to the master branch. Commit message should consist of version number, prepended with letter v
(example: `v1.2.3`). Push the changes, then create new release from the master branch.
In release description paste the contents of given version from `CHANGELOG.md`.

### 5. ...and its done!

Release invokes a bunch of scripts responsible for splitting components, pushing them to read-only
repos and updating packagist information. That will take a minute or two.