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