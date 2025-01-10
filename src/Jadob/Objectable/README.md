# jadob/objectable

Reflection-based class normalizer. 


## Usage
```php
class UserReadModel {
    
    public function __construct(
    #[\Jadob\Objectable\Annotation\Field(name: 'username', context: ['PUBLIC_API', 'PRIVATE_API'])]
    private string $username,

    #[\Jadob\Objectable\Annotation\Field(name: 'banReason',  context: ['PRIVATE_API'])]    
    private string $banReason,
    
    #[\Jadob\Objectable\Annotation\Field(name: 'createdAt',  context: ['PUBLIC_API', 'PRIVATE_API'], dateFormat: 'Y-m-d')]
    private DateTimeInterface $createdAt
    ) {
    
    }
}

$user = new UserReadModel('mickey', 'spam', new DateTime('2012-12-12'));

$itemProcessor = new \Jadob\Objectable\ItemProcessor();

/**
 *  ['username' => 'mickey', 'createdAt' => '2012-12-12']
 */
$publicResponse = $itemProcessor->extractItemValues($user, 'PUBLIC_API');


/**
 *  ['username' => 'mickey', 'banReason' => 'spam', 'createdAt' => '2012-12-12']
 */
$managementResponse = $itemProcessor->extractItemValues($user, 'PRIVATE_API');

```


When you need to handle specific use case, you can create a class implementing
`Jadob\Objectable\Transformer\ItemTransformerInterface` and pass them to `ItemProcessor`:


```php
class MyClass {
    public function __construct(
        public string $key
    ) {}
}

class TopSecretTransformer implements \Jadob\Objectable\Transformer\ItemTransformerInterface {

    public function supports(string $className,string $context) : bool {
    
        return $className === MyClass::class && $context === 'TOP_SECRET';
    }   
    
    /**
     * @param MyClass $object
     * @return array
     */
    public function process(object $object) : array{
        return [
            'key' => str_rot13($object->key)
        ];   
    }
}


$itemProcessor = new \Jadob\Objectable\ItemProcessor(
    itemTransformers: [
        new TopSecretTransformer()
    ]
);

/**
 * ['key' => 'uryyb']
 */
$result = $itemProcessor->extractItemValues(new MyClass('hello'), 'TOP_SECRET');
```

When any transformer would be matched, `extractItemValues` will return the values from transformers, no further processing will be done.