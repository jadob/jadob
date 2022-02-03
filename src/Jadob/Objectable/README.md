# pizzaminded/objectable

Turn your array of objects into html table or whatever you want to by using ``doctrine/annotations``. Twig Extension included. Inspired by [My Old Bundle](https://github.com/pizzaminded/EntableBundle). 

PHP 7.3 required.



## Annotations Reference

### One important thing before we get started

Properties in examples are ``public`` only for example. Objectable uses ``symfony/property-access`` to 
access values.

### Objectable\ActionField

Adds action field to each row.

Properties:
- ``name`` - *Required* action name. Should be unique for each action defined for object. This value will be also 
passed to action field as a class with ``objectable-action-`` prefix and as a value of ``data-objectable-action`` attribute. 
- ``path`` - URL (or route identifier) that user will be redirected for. (required)
- ``label``- Value shown as a content of given button. (required)
- ``property`` - property that will be passed to ActionFieldTransformer to generate an redirect URL. If null,
the whole object will be passed.
- ``key`` - Name of param that value from ``property`` field will be passed.


#### Example:

````php
<?php 

use Jadob\Objectable\Annotation as Objectable;

/**
 * @Objectable\Row()
 * @Objectable\ActionField(name="edit", label="Edit User", path="/user/edit", property="id")
 * @Objectable\ActionField(name="remove", label="Remove User", path="/user/remove", property="id")
 */
 class User {/* ... */}
````

For User object with ID = 1, default ActionFieldTransformer will create two buttons with URLs:
- ``/user/edit?id=1`` 
- ``/user/remove?id=1``


### Objectable\Header

Defines a field which will be rendered and sets the column name for them.

Objectable will look only for ``order`` value passed in annotation. The order of properties written in object
does not matter.


Properties:
- ``title`` - Column name for current property. (required)
- ``order`` - Position of current column. (required)

#### Example:


````php
<?php 

use Jadob\Objectable\Annotation as Objectable;

class Person {

    /**
     * @Objectable\Header(title="ID", order=1) 
     * @var int
     */
    public $id;
    
    /**
     * @Objectable\Header(title="Last Name", order=3) 
     * @var string
     */
    public $lastName;
    
    /**
      * @Objectable\Header(title="First Name", order=2) 
      * @var string
      */
    public $firstName;

}

````

These will be rendered like:


|ID|First Name|Last Name
|---|---|---|
|2|Mickey|Rourke
|3|Mike|Tyson
|4|Michael|Jordan


## Transformers Reference

Allows to modify rendered content to fit to your business needs.

### Custom Header Transformer

Using Custom Header Transformer you can e.g translate headers easily. 

#### Example:

````php
<?php

class UpperCaseTransformer implements \Jadob\Objectable\Transformer\HeaderTransformerInterface {
    
    /**
     * @param string $title
     * @param string $className
     * @param string $propertyName
     * @return string
     */
    public function transform(string $title, string $className, string $propertyName): string
    {
        return \strtoupper($title);
    }
}


/** @var \Jadob\Objectable\Objectable $objectable */
$objectable->setHeaderTransformer(new UpperCaseTransformer());

````

### Custom Action Field Transformer

@TODO

### Things that need to be done before ``1.0.0`` release:

- [ ] Odd\Even Rows
- [ ] Action Fields
- [ ] Tests
- [ ] Custom Template Renderers
- [ ] ``translatable`` parameter for header
- [ ] defining custom getter for properties

## Tests

@TODO

## License

MIT, see LICENSE file for more
