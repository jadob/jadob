# List operation configuration

## Predefined criteria
Allows you to call custom method from your object repository and render `object[]` returned 
from them. This may be used for more business-specific querying.

Your repository method will be called with:
 - `DateTimeInterface` with current date as a first argument;
 - `object` with current user as a second argument;

### Array syntax config

````
return [
    'predefined_criteria' => [
        'duplicated_brands_by_name' => [
            'method' => 'findDuplicatesByName',
            'label' => 'domain.brand.find_duplicates'
        ]
    ]
]
````

Each key in `predefined_criteria` is name of your criteria, `method` contains `string` with name of method to be called,
value from `label` will be passed through transformer (when available) and shown in dropdown list above the table in `list` view.

### Expected return value

Dashboard expects that your return value will be `object[]`. Default object rendering apply.