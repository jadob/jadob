# Symfony Translation  Bridge
## Configuration Reference

### Config node name
``translation``

### Config node fields:
- ``locale`` - boolean - current user locale, that may be changed later by using ``setLocale()`` method in translation contract;
- ``sources`` - array - list of translation files with locales, file path and resource type. 
  Single resource structure:
  
  - `locale` - string - language of given resource
  - `type` - string - resource type (e.g. array, yaml, etc.) (for now only array is supported.)
  - `path`  - string - absolute path to resource.
  - `group` - string - translation domain (validation, messages etc.)
  
  
### Example config node structure

```php
<?php 
//%CONFIG_DIR%/translation.php

return [
    'locale' => 'en',  
    'sources' => [
        [
            'locale' => 'pl',
            'type' => 'array',
            'path' => __DIR__.'/translations/pl/domain.php'
        ],
        [
            'locale' => 'en',
            'type' => 'array',
            'path' => __DIR__.'/translations/en/domain.php'
        ]
    ]
];
```