# jadob/objectable 


## Object serialization
You can manually declare which fields would be serialized by attributing them:


``
use Jadob\Objectable\Annotation\Field;

class Product {

    #[Field(name: 'id', order: 1)]
    protected string $name;

    #[Field(name: 'name', order: 2)]
    protected string $name;

}
``

If a property you want to serialize is an object, you can add `stringable: true`, and object would be typecasted to string:

``
use Jadob\Objectable\Annotation\Field;
use Ramsey\Uuid\UuidInterface;

class Product {

    #[Field(name: 'id', order: 1. stringable: true)]
    protected UuidInterface $name;

    #[Field(name: 'name', order: 2)]
    protected string $name;

}
``