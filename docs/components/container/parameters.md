# Parameters

## Adding new parameter

You can add/override parameters by using `Container#addParameter` method:

````
$container = getContainer();
$container->addParameter('mailer.reply-to-address', 'hello@example.com');
````

## Getting a value of a parameter:

Use `getParameter` method:
````
$container = getContainer();
$container->getParameter('mailer.reply-to-address');
````

You can also inject a param to your services by using `#[InjectParam]` attribute:

````
use Jadob\Contracts\Container\Attribute\InjectParam;

class MailerService {
    public function __construct(
        #[InjectParam('mailer.reply-to-address')] protected string $replyToAddress
    )
}
````

When there will be no parameter defined, an Exception will be thrown.
