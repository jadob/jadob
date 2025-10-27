# Jadob development guidelines

Every single bit of information in this directory applies only to `jadob/jadob` project. 



## PHPUnit test groups
Please add `@group (group)` with these groups to each test you add:

- `container`
- - `container-definitions`
- - `container-service-providers`
- - `container-builder`
- - `container-find-by-fqcn`

You can add
Add here more of them when needed.

## New package checklist:
- Package is MIT-licensed
- Package has its own 1composer.json 1file
- `rdepcheck` does not show any errors related with new package
- If package has some "specific" files that should not be tested, then these files are defined in phpunit/psalm excludes
- Package does not rely on `jadob/core` 
