# Sending emails using `jadob/aws-bridge`


## 1. Install required vendors 


## 2. Add depedencies to your service container
Add new entries in your services.php:

```php
use Psr\Container\ContainerInterface;
use Aws\Sdk;
use Jadob\Bridge\Aws\Ses\SesMailer;

return [
    //SDK class is required for SesClient Creation
    Sdk::class => static function () {
        return new Sdk([
           //provide your region/credentials here
        ]);
    },
    //SesMailer is just a wrapper for a SesClient and symfony/mime
    SesMailer::class => static function (ContainerInterface $container) {
            return new SesMailer(
                $container->get($container->get(Sdk::class)->createSes())
            );
     },
];
```

### 2.1 Cross-account mailing
*Skip this step when you send messages from same account as passed in `Sdk` class.*

*Also this step assumes that you configured your SES for cross-account mailing earlier.*

There can be a use case when your app has to send email from another account. To enable this feature, modify your
`SesMailer` service definition:

```diff
    SesMailer::class => static function (ContainerInterface $container) {
            return new SesMailer(
+                $container->get($container->get(Sdk::class)->createSes()),
+                [ 
+                    'source_arn' => 'ARN:of:identity:that:permits:you:to:send:email:specified:in:Source:parameter'
+                    'from_arn' => 'ARN:of:identity:that:permits:you:to:specify:particular:From:parameter'
+                    'return_path_arn' => 'ARN:of:identity:that:permits:you:to:specify:particular:ReturnPath:parameter'
+                ]
           );
     },

```

Meaning of particular attributes has been taken from [AWS SES Developer Guide](https://docs.aws.amazon.com/ses/latest/DeveloperGuide/sending-authorization-delegate-sender-tasks-email.html).
## 3.Prepare your e-mail message