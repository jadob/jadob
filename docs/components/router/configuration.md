# jadob/router

Configuration reference



## All possible parameters

````php
<?php

return [
  'case_sensitive' => false,
  'optional_locale' => false,
];
````

### ``case_sensitive``

Default ``false``


### ``optional_locale``

If enabled, router will **additionally** match all routes which begins with ISO 3166-1 alfa-2
country code. **It will match routes without them too, this feature will not break your routing.**

Example:

Paths ``/pl/posts/{id}`` and ``/en/posts/{id}`` and ``/posts/{id}`` will match the same route, 
but ``_locale`` parameter will be different for each of them.