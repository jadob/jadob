# New package checklist:
- Package is MIT-licensed
- Package has its own composer.json file
- `rdepcheck` does not show any errors related with new package
- If package has some "specific" files that should not be tested, then these files are defined in phpunit/psalm excludes
- Package does not rely on `jadob/core` 
