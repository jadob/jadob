# jadob/symfony-translation-bridge

Integrates ``symfony/translation``  with Jadob.

**Warning** Version at least `5.0` required.


## Configuration Reference

### Config node name
``translator``

### Config node fields:
- ``locale`` - boolean - current user locale, that may be changed later by using ``setLocale()`` method in translation contract;
- ``sources`` - array - list of translation files with locales, file path and resource type. 
  Single resource structure:
  
  - `locale` - string - language of given resource
  - `path`  - string - relative (beginning from ROOT_DIR) path to translation file.
  - `domain` - string - translation domain (validation, messages etc.)
  
  
### Example config node structure

```php
<?php 
//%CONFIG_DIR%/translator.php

return [
    'locale' => 'en',  
    'logging' => true,
    'supported_locales' => ['en', 'pl'],
    'sources' => [
        [
            'locale' => 'pl',
            'domain' => 'messages',
            'path' => '/translations/pl/messages.php'
        ],
        [
            'locale' => 'en',
            'domain' => 'messages',
            'path' => '/translations/en/messages.php'
        ]
    ]
];
```

## Automatically Added Sources

Jadob will add your translations automatically when they are stored in specific directory structure:

``${CONFIG_DIR}/translations/{locale}/{domain}.php``

Where:
- ``locale`` is two-letter country code (like `en`, `cz`);
- File name is treated as a ``domain``.

A ``glob`` function is used to scan these directories. These sources are loaded first, so any source defined in translator
config node can override it. 

## Logging

You can set ``logging`` attribute to `true` in your config file to enable translator logger. Each operation will be logged
to default logger handler.






