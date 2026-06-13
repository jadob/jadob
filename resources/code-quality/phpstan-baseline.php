<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'message' => '#^Call to static method uuid4\\(\\) on an unknown class Ramsey\\\\Uuid\\\\Uuid\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method toString\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:assignAggregateId\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:assignRecordTimestamp\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:popUncommittedEvents\\(\\) should return array\\<Jadob\\\\Aggregate\\\\AbstractDomainEvent\\> but returns array\\<Jadob\\\\Aggregate\\\\DomainEventInterface\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:recreate\\(\\) has parameter \\$events with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$event of method Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:apply\\(\\) expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:\\$aggregateId \\(string\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:\\$aggregateVersion is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:\\$events type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Aggregate\\\\AbstractAggregateRoot\\:\\:\\$recordedEvents \\(array\\<Jadob\\\\Aggregate\\\\DomainEventInterface\\>\\) does not accept array\\<object\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractAggregateRoot.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method generate\\(\\) on an unknown class Ulid\\\\Ulid\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractDomainEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot cast mixed to string\\.$#',
	'identifier' => 'cast.string',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractDomainEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractDomainEvent\\:\\:assignEventId\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractDomainEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractDomainEvent\\:\\:assignRecordTimestamp\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractDomainEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AbstractDomainEvent\\:\\:getAttributes\\(\\) should return array\\<string, string\\> but returns array\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractDomainEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Aggregate\\\\AbstractDomainEvent\\:\\:\\$attributes type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AbstractDomainEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method createFromMilliseconds\\(\\) on an unknown class Jadob\\\\EventStore\\\\DateTimeFactory\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'agv\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'aid\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'eid\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'ety\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'pld\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'tme\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var with type Jadob\\\\Aggregate\\\\AbstractAggregateRoot is not subtype of native type string\\.$#',
	'identifier' => 'varTag.nativeType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serialized of method Jadob\\\\EventStore\\\\PayloadSerializer\\:\\:deserialize\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$eventId of static method Jadob\\\\Aggregate\\\\DomainEventInterface\\:\\:recreate\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#4 \\$version of static method Jadob\\\\Aggregate\\\\DomainEventInterface\\:\\:recreate\\(\\) expects int, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#5 \\$recordedAt of static method Jadob\\\\Aggregate\\\\DomainEventInterface\\:\\:recreate\\(\\) expects DateTimeInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\AggregateRootInterface\\:\\:recreate\\(\\) has parameter \\$events with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/AggregateRootInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\DomainEventInterface\\:\\:recreate\\(\\) has parameter \\$payload with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/DomainEventInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Aggregate\\\\DomainEventInterface\\:\\:toArray\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Aggregate/DomainEventInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\AccessToken\\\\AccessToken\\:\\:__construct\\(\\) has parameter \\$metadata with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/AccessToken/AccessToken.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \\(float\\|int\\) on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/AccessToken/AccessTokenStorage.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot use \\+\\+ on mixed\\.$#',
	'identifier' => 'postInc.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/AccessToken/AccessTokenStorage.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\EventListener\\\\AuthenticationEventListener\\:\\:getListenersForEvent\\(\\) return type has no value type specified in iterable type iterable\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/EventListener/AuthenticationEventListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$firewall of method Jadob\\\\Auth\\\\EventListener\\\\AuthenticationEventListener\\:\\:findStackedToken\\(\\) expects Jadob\\\\Auth\\\\Firewall\\\\Firewall, Jadob\\\\Auth\\\\Firewall\\\\FirewallInterface given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/EventListener/AuthenticationEventListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\Firewall\\\\Firewall\\:\\:getIdentityPicker\\(\\) should return Jadob\\\\Auth\\\\Identity\\\\IdentityPickerInterface but returns Jadob\\\\Auth\\\\Identity\\\\IdentityPickerInterface\\|null\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/Firewall/Firewall.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\Module\\\\AuthenticationModule\\:\\:getEventListeners\\(\\) should return list\\<Psr\\\\EventDispatcher\\\\ListenerProviderInterface\\> but returns array\\{mixed\\}\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/Module/AuthenticationModule.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$firewalls on array\\|Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationServiceProvider\\:\\:getConfigNode\\(\\) never returns null so it can be removed from the return type\\.$#',
	'identifier' => 'return.unusedType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Psr\\\\Container\\\\ContainerInterface\\:\\:get\\(\\) expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$config \\(array\\|Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationConfig\\|null\\) of method Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationServiceProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(array\\|object\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$accessTokenStorage of class Jadob\\\\Auth\\\\EventListener\\\\AuthenticationEventListener constructor expects Jadob\\\\Auth\\\\AccessToken\\\\AccessTokenStorageInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$entryPoint of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects Jadob\\\\Auth\\\\EntryPointInterface\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$firewallMap of class Jadob\\\\Auth\\\\EventListener\\\\AuthenticationEventListener constructor expects Jadob\\\\Auth\\\\Firewall\\\\FirewallMapInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$identityPicker of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects Jadob\\\\Auth\\\\Identity\\\\IdentityPickerInterface\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$identityProvider of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects Jadob\\\\Auth\\\\Identity\\\\IdentityProviderInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$logger of class Jadob\\\\Auth\\\\EventListener\\\\AuthenticationEventListener constructor expects Psr\\\\Log\\\\LoggerInterface\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$requestMatcher of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects Symfony\\\\Component\\\\HttpFoundation\\\\RequestMatcherInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\<array\\|object\\>\\) of method Jadob\\\\Auth\\\\ServiceProvider\\\\AuthenticationServiceProvider\\:\\:register\\(\\) should be covariant with return type \\(array\\<string, array\\|object\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\ServiceProvider\\\\FirewallConfig\\:\\:getAuthenticators\\(\\) should return array\\<string\\> but returns array\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/FirewallConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Auth\\\\ServiceProvider\\\\FirewallConfig\\:\\:\\$authenticators type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/FirewallConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Auth\\\\ServiceProvider\\\\FirewallConfig\\:\\:\\$name is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/FirewallConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'AccessKeyId\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'SecretAccessKey\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'SessionToken\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Default value of the parameter \\#3 \\$config \\(array\\{\\}\\) of method Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\AssumeRoleSesMailer\\:\\:__construct\\(\\) is incompatible with type array\\{source_arn\\: string, from_arm\\: string, return_path_arn\\: string\\}\\.$#',
	'identifier' => 'parameter.defaultValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\AssumeRoleSesMailer\\:\\:__construct\\(\\) does not call parent constructor from Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\SesMailer\\.$#',
	'identifier' => 'constructor.missingParentCall',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\AssumeRoleSesMailer\\:\\:\\$assumedCredentials type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\SesMailer\\:\\:\\$config \\(array\\{source_arn\\: string, from_arn\\: string, return_path_arn\\: string\\}\\) does not accept array\\{source_arn\\: string, from_arm\\: string, return_path_arn\\: string\\}\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/AssumeRoleSesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method toString\\(\\) on Symfony\\\\Component\\\\Mime\\\\Address\\|false\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/SesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Default value of the parameter \\#2 \\$config \\(array\\{\\}\\) of method Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\SesMailer\\:\\:__construct\\(\\) is incompatible with type array\\{source_arn\\: string, from_arm\\: string, return_path_arn\\: string\\}\\.$#',
	'identifier' => 'parameter.defaultValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/SesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\SesMailer\\:\\:\\$config \\(array\\{source_arn\\: string, from_arn\\: string, return_path_arn\\: string\\}\\) does not accept array\\{source_arn\\: string, from_arm\\: string, return_path_arn\\: string\\}\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/SesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Aws\\\\Ses\\\\SesMailer\\:\\:\\$config in isset\\(\\) is not nullable nor uninitialized\\.$#',
	'identifier' => 'isset.initializedProperty',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Aws/Ses/SesMailer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Common\\\\ServiceProvider\\\\DoctrineCommonServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Common/ServiceProvider/DoctrineCommonServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Common\\\\ServiceProvider\\\\DoctrineCommonServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Common/ServiceProvider/DoctrineCommonServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\:\\:addConnection\\(\\) has parameter \\$configuration with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\:\\:getConnections\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\:\\:getMappingTypes\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\:\\:getTypes\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\:\\:\\$connections \\(array\\<string, array\\{configuration\\: array\\<string\\>, default\\: bool\\}\\>\\) does not accept non\\-empty\\-array\\<string, array\\{configuration\\: array, default\\: bool\\}\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\:\\:\\$types \\(array\\<string, class\\-string\\>\\) does not accept array\\<string, string\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Doctrine\\\\DBAL\\\\Connection but returns object\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between mixed and \'/dbal\\.log\' results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'configuration\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'default\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getConnections\\(\\) on array\\|Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getLogsDir\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getMappingTypes\\(\\) on array\\|Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getTypes\\(\\) on array\\|Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:resolveConnectionConfiguration\\(\\) has parameter \\$configuration with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:resolveConnectionConfiguration\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$configuration of method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:resolveConnectionConfiguration\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$dsn of method Doctrine\\\\DBAL\\\\Tools\\\\DsnParser\\:\\:parse\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$params of static method Doctrine\\\\DBAL\\\\DriverManager\\:\\:getConnection\\(\\) expects array\\{application_name\\?\\: string, charset\\?\\: string, dbname\\?\\: string, defaultTableOptions\\?\\: array\\<string, mixed\\>, driver\\?\\: \'ibm_db2\'\\|\'mysqli\'\\|\'oci8\'\\|\'pdo_mysql\'\\|\'pdo_oci\'\\|\'pdo_pgsql\'\\|\'pdo_sqlite\'\\|\'pdo_sqlsrv\'\\|\'pgsql\'\\|\'sqlite3\'\\|\'sqlsrv\', driverClass\\?\\: class\\-string\\<Doctrine\\\\DBAL\\\\Driver\\>, driverOptions\\?\\: array\\<mixed\\>, host\\?\\: string, \\.\\.\\.\\}, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$types of method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:registerTypes\\(\\) expects array\\<string, class\\-string\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$config \\(array\\|Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\Configuration\\\\DbalConfiguration\\|null\\) of method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(array\\|object\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$doctrineType of method Doctrine\\\\DBAL\\\\Platforms\\\\AbstractPlatform\\:\\:registerDoctrineTypeMapping\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$type of static method Doctrine\\\\DBAL\\\\Types\\\\Type\\:\\:addType\\(\\) expects class\\-string\\<Doctrine\\\\DBAL\\\\Types\\\\Type\\>\\|Doctrine\\\\DBAL\\\\Types\\\\Type, class\\-string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\<Closure\\|Doctrine\\\\Common\\\\EventManager\\>\\) of method Jadob\\\\Bridge\\\\Doctrine\\\\DBAL\\\\ServiceProvider\\\\DoctrineDBALProvider\\:\\:register\\(\\) should be covariant with return type \\(array\\<string, array\\|object\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/DBAL/ServiceProvider/DoctrineDBALProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Doctrine\\\\Migrations\\\\DependencyFactory\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Doctrine\\\\Migrations\\\\DependencyFactory but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method fromEntityManager\\(\\) on an unknown class Doctrine\\\\Migrations\\\\DependencyFactory\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method withSimpleDefault\\(\\) on an unknown class Doctrine\\\\Migrations\\\\Configuration\\\\EntityManager\\\\ManagerRegistryEntityManager\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\DependencyFactory not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\DiffCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\DumpSchemaCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\ExecuteCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\GenerateCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\LatestCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\ListCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\MigrateCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\RollupCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\StatusCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\SyncMetadataCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\VersionCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Configuration\\\\Migration\\\\ConfigurationArray not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\DiffCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\DumpSchemaCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\ExecuteCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\GenerateCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\LatestCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\ListCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\MigrateCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\RollupCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\StatusCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\SyncMetadataCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Doctrine\\\\Migrations\\\\Tools\\\\Console\\\\Command\\\\VersionCommand not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\ServiceProvider\\\\DoctrineMigrationsProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\ServiceProvider\\\\DoctrineMigrationsProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$dependencyFactory of anonymous function has invalid type Doctrine\\\\Migrations\\\\DependencyFactory\\.$#',
	'identifier' => 'class.notFound',
	'count' => 11,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\Console\\\\MultipleEntityManagerProvider\\:\\:getDefaultManager\\(\\) should return Doctrine\\\\ORM\\\\EntityManagerInterface but returns Doctrine\\\\Persistence\\\\ObjectManager\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/Console/MultipleEntityManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\Console\\\\MultipleEntityManagerProvider\\:\\:getManager\\(\\) should return Doctrine\\\\ORM\\\\EntityManagerInterface but returns Doctrine\\\\Persistence\\\\ObjectManager\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/Console/MultipleEntityManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Doctrine\\\\ORM\\\\EntityManager but returns Doctrine\\\\Persistence\\\\ObjectManager\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between mixed and \'/\' results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'default\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'entity_paths\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'managers\' on array\\|object\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'string_functions\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getCacheDir\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getRootDir\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\ServiceProvider\\\\DoctrineORMProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\ServiceProvider\\\\DoctrineORMProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @return with type Closure is incompatible with native type array\\.$#',
	'identifier' => 'return.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$conn of class Doctrine\\\\ORM\\\\EntityManager constructor expects Doctrine\\\\DBAL\\\\Connection, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Doctrine\\\\ORM\\\\Configuration\\:\\:addCustomStringFunction\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$string of function ltrim expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$className of method Doctrine\\\\ORM\\\\Configuration\\:\\:addCustomStringFunction\\(\\) expects \\(callable\\(string\\)\\: Doctrine\\\\ORM\\\\Query\\\\AST\\\\Functions\\\\FunctionNode\\)\\|class\\-string\\<Doctrine\\\\ORM\\\\Query\\\\AST\\\\Functions\\\\FunctionNode\\>, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$eventManager of class Doctrine\\\\ORM\\\\EntityManager constructor expects Doctrine\\\\Common\\\\EventManager\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\) of method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\ServiceProvider\\\\DoctrineORMProvider\\:\\:register\\(\\) should be covariant with return type \\(array\\<string, array\\|object\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\<class\\-string\\>\\) of method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\ServiceProvider\\\\DoctrineORMProvider\\:\\:getParentServiceProviders\\(\\) should be covariant with return type \\(list\\<class\\-string\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ParentServiceProviderInterface\\:\\:getParentServiceProviders\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/ORM/ServiceProvider/DoctrineORMProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getRepository\\(\\) on Doctrine\\\\Persistence\\\\ObjectManager\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineManagerRegistry\\:\\:getConnectionNames\\(\\) should return array\\<string, string\\> but returns list\\<\\(int\\|string\\)\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineManagerRegistry\\:\\:getConnections\\(\\) should return array\\<string, object\\> but returns array\\<Doctrine\\\\DBAL\\\\Connection\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineManagerRegistry\\:\\:getManagerNames\\(\\) should return array\\<string, string\\> but returns list\\<\\(int\\|string\\)\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineManagerRegistry\\:\\:getManagers\\(\\) should return array\\<string, Doctrine\\\\Persistence\\\\ObjectManager\\> but returns array\\<Doctrine\\\\Persistence\\\\ObjectManager\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in an if condition, string\\|null given\\.$#',
	'identifier' => 'if.condNotBoolean',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ServiceProvider\\\\DoctrinePersistenceProvider\\:\\:onContainerBuild\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/ServiceProvider/DoctrinePersistenceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ServiceProvider\\\\DoctrinePersistenceProvider\\:\\:onContainerBuild\\(\\) has parameter \\$config with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/ServiceProvider/DoctrinePersistenceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ServiceProvider\\\\DoctrinePersistenceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/ServiceProvider/DoctrinePersistenceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ServiceProvider\\\\DoctrinePersistenceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/ServiceProvider/DoctrinePersistenceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has an unused use \\$useCache\\.$#',
	'identifier' => 'closure.unusedUse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Dynamite\\\\ItemManager\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Dynamite\\\\ItemManagerRegistry\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Dynamite\\\\ItemSerializer\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Dynamite\\\\Mapping\\\\ItemMappingReader\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Dynamite\\\\PrimaryKey\\\\KeyFormatResolver\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Dynamite\\\\Mapping\\\\ItemMappingReader but returns Dynamite\\\\Mapping\\\\CachedItemMappingReader\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method addFilter\\(\\) on an unknown class Dynamite\\\\PrimaryKey\\\\KeyFormatResolver\\.$#',
	'identifier' => 'class.notFound',
	'count' => 5,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method addManagedTable\\(\\) on an unknown class Dynamite\\\\ItemManagerRegistry\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'cache\' on array\\|object\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'connection\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'indexes\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'managed_objects\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'partition_key_name\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'sort_key_name\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'table_name\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'tables\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Dynamite\\\\ItemManagerRegistry not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Dynamite\\\\ItemSerializer not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Dynamite\\\\PrimaryKey\\\\KeyFormatResolver not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\ItemManager not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\ItemManagerRegistry not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\ItemSerializer not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\Mapping\\\\CachedItemMappingReader not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\Mapping\\\\ItemMappingReader not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\PrimaryKey\\\\Filter\\\\LowercaseFilter not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\PrimaryKey\\\\Filter\\\\Md5Filter not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\PrimaryKey\\\\Filter\\\\NoDashFilter not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\PrimaryKey\\\\Filter\\\\UppercaseFilter not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\PrimaryKey\\\\Filter\\\\UppercaseFirstFilter not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\PrimaryKey\\\\KeyFormatResolver not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Dynamite\\\\TableSchema not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteProvider\\:\\:onContainerBuild\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteProvider\\:\\:onContainerBuild\\(\\) has parameter \\$config with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Psr\\\\Container\\\\ContainerInterface\\:\\:get\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Possibly invalid array key type mixed\\.$#',
	'identifier' => 'offsetAccess.invalidOffset',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Bridge\\\\Monolog\\\\LoggerFactory\\:\\:\\$streams type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Monolog/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\ProxyManager\\\\ServiceProvider\\\\ProxyManagerProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/ProxyManager/ServiceProvider/ProxyManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\ProxyManager\\\\ServiceProvider\\\\ProxyManagerProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/ProxyManager/ServiceProvider/ProxyManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function spl_autoload_register expects \\(callable\\(string\\)\\: void\\)\\|null, ProxyManager\\\\Autoloader\\\\AutoloaderInterface given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/ProxyManager/ServiceProvider/ProxyManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/ProxyManager/ServiceProvider/ProxyManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type Symfony\\\\Component\\\\Form\\\\FormExtensionInterface supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Symfony\\\\Form\\\\ServiceProvider\\\\SymfonyFormProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Symfony\\\\Form\\\\ServiceProvider\\\\SymfonyFormProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var with type Symfony\\\\Component\\\\Form\\\\FormExtensionInterface is not subtype of native type array\\.$#',
	'identifier' => 'varTag.nativeType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$defaultThemes of class Symfony\\\\Bridge\\\\Twig\\\\Form\\\\TwigRendererEngine constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$extension of method Symfony\\\\Component\\\\Form\\\\FormFactoryBuilderInterface\\:\\:addExtension\\(\\) expects Symfony\\\\Component\\\\Form\\\\FormExtensionInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$value of function count expects array\\|Countable, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$array of function array_key_exists expects array, array\\|object\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Symfony\\\\Validator\\\\ServiceProvider\\\\SymfonyValidatorProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Validator/ServiceProvider/SymfonyValidatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Symfony\\\\Validator\\\\ServiceProvider\\\\SymfonyValidatorProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Validator/ServiceProvider/SymfonyValidatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:addExtension\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Container/Extension/TwigExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:addRuntimeLoader\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Container/Extension/TwigExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getName\\(\\) on ReflectionType\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Container/Extension/TwigExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$function of class ReflectionFunction constructor expects Closure\\|string, object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Container/Extension/TwigExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Possibly invalid array key type mixed\\.$#',
	'identifier' => 'offsetAccess.invalidOffset',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Container/Extension/TwigExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Function r not found\\.$#',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/DebugExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\DebugExtension\\:\\:debug\\(\\) should return string\\|null but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/DebugExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\DebugExtension\\:\\:getFunctions\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/DebugExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\) of method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\DebugExtension\\:\\:getFunctions\\(\\) should be covariant with return type \\(array\\<Twig\\\\TwigFunction\\>\\) of method Twig\\\\Extension\\\\AbstractExtension\\:\\:getFunctions\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/DebugExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\) of method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\DebugExtension\\:\\:getFunctions\\(\\) should be covariant with return type \\(array\\<Twig\\\\TwigFunction\\>\\) of method Twig\\\\Extension\\\\ExtensionInterface\\:\\:getFunctions\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/DebugExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between \'\\:\' and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between \'http\\://\'\\|\'https\\://\' and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Router\\\\Router\\:\\:getContext\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getHost\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getPort\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method isSecure\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\PathExtension\\:\\:path\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\PathExtension\\:\\:url\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/PathExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\ViteManifestAssetExtension\\:\\:getAssetFromManifest\\(\\) should return string but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/ViteManifestAssetExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Offset \'file\' does not exist on string\\.$#',
	'identifier' => 'offsetAccess.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/ViteManifestAssetExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between mixed and \'/\' results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:getRootDir\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'aliased_paths\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'cache\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'extensions\' on array\\|object\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'manifest_json_location\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'templates_paths\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'vite_manifest\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'webpack_manifest\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot cast mixed to string\\.$#',
	'identifier' => 'cast.string',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\ServiceProvider\\\\TwigProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\ServiceProvider\\\\TwigProvider\\:\\:register\\(\\) should return array\\{Twig\\\\Loader\\\\LoaderInterface\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Twig\\\\Loader\\\\FilesystemLoader, Twig\\\\Environment\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Twig\\\\Environment\\} but returns array\\{Twig\\\\Loader\\\\LoaderInterface\\: Closure\\(Jadob\\\\Container\\\\Container\\)\\: Twig\\\\Loader\\\\FilesystemLoader, Twig\\\\Environment\\: Closure\\(Twig\\\\Loader\\\\LoaderInterface, Jadob\\\\Container\\\\ParameterStore, Jadob\\\\Container\\\\Container\\)\\: Twig\\\\Environment, Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\PathExtension\\: array\\{tags\\: array\\{\'twig\\.extension\'\\}, factory\\: Closure\\(Jadob\\\\Router\\\\Router\\)\\: Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\PathExtension\\}, Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\DebugExtension\\: array\\{tags\\: array\\{\'twig\\.extension\'\\}, class\\: \'Jadob\\\\\\\\Bridge\\\\\\\\Twig\\\\\\\\Extension\\\\\\\\DebugExtension\'\\}, Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\AliasedAssetPathExtension\\: array\\{tags\\: array\\{\'twig\\.extension\'\\}, factory\\: Closure\\(\\)\\: Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\AliasedAssetPathExtension\\}, \'twig\\.webpack_manifest_extension\'\\?\\: array\\{tags\\: array\\{\'twig\\.extension\'\\}, factory\\: Closure\\(Jadob\\\\Container\\\\ParameterStore\\)\\: Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\WebpackManifestAssetExtension\\}, \'twig\\.vite_manifest_extension\'\\?\\: array\\{tags\\: array\\{\'twig\\.extension\'\\}, factory\\: Closure\\(Jadob\\\\Container\\\\ParameterStore\\)\\: Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\ViteManifestAssetExtension\\}, \'twig\\.translator_extension\'\\: array\\{tags\\: array\\{\'twig\\.extension\'\\}, factory\\: Closure\\(Symfony\\\\Contracts\\\\Translation\\\\TranslatorInterface\\)\\: Symfony\\\\Bridge\\\\Twig\\\\Extension\\\\TranslationExtension\\}\\}\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$assets of class Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\AliasedAssetPathExtension constructor expects array\\<string, string\\>, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$json of function json_decode expects string, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$manifest of class Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\ViteManifestAssetExtension constructor expects array\\<string\\>, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$manifest of class Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\WebpackManifestAssetExtension constructor expects array\\<string\\>, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$path of function dirname expects string, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$string of function ltrim expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$namespace of method Twig\\\\Loader\\\\FilesystemLoader\\:\\:addPath\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type list\\<string\\>\\|false supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Config\\\\Config\\:\\:getNode\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Config\\\\Config\\:\\:getNode\\(\\) should return array but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Config\\\\Config\\:\\:loadDirectory\\(\\) has parameter \\$extensions with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Config\\\\Config\\:\\:loadDirectory\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Config\\\\Config\\:\\:toArray\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$array of function extract expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Config\\\\Config\\:\\:\\$nodes type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Config/Config.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method ReflectionType\\:\\:getName\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getName\\(\\) on ReflectionType\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:add\\(\\) has parameter \\$service with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:addServiceFromArray\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:build\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:createDefinition\\(\\) has parameter \\$serviceConfig with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:fromArrayConfiguration\\(\\) has parameter \\$configuration with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:instantiate\\(\\) should return object but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Container\\:\\:resolveServiceProviders\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Offset string does not exist on list\\<object\\>\\.$#',
	'identifier' => 'offsetAccess.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in an if condition, string\\|null given\\.$#',
	'identifier' => 'if.condNotBoolean',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$providerConfig has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$array of function array_values expects array\\<class\\-string\\>, array\\<string, class\\-string\\>\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$autowired of method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:setAutowired\\(\\) expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$class of function class_exists expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$class of method Jadob\\\\Container\\\\Container\\:\\:updateClassMap\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$class of method Jadob\\\\Container\\\\Container\\:\\:updateClassMap\\(\\) expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$class of method Jadob\\\\Container\\\\Container\\:\\:updateInterfaceMap\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$class of method Jadob\\\\Container\\\\Container\\:\\:updateInterfaceMap\\(\\) expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$className of method Jadob\\\\Container\\\\Container\\:\\:make\\(\\) expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$factory of method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:setFactory\\(\\) expects Closure, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$function of class ReflectionFunction constructor expects Closure\\|string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\Container\\:\\:add\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\Container\\:\\:get\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\Container\\:\\:has\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:setClassName\\(\\) expects class\\-string, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 5,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$objectOrClass of class ReflectionClass constructor expects class\\-string\\<T of object\\>\\|T of object, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serviceId of static method Jadob\\\\Container\\\\Container\\:\\:createDefinition\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serviceProviders of method Jadob\\\\Container\\\\ServiceProviderResolver\\:\\:resolveServiceProvidersOrder\\(\\) expects list\\<Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\>, array\\<Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$tags of method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:setTags\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$array of function implode expects array\\<string\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$config of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\) expects array\\|object\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$serviceConfig of static method Jadob\\\\Container\\\\Container\\:\\:createDefinition\\(\\) expects array\\|object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$argumentAttributes of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerAutowiringExtensionInterface\\:\\:injectConstructorArgument\\(\\) expects list\\<Attribute\\>, list\\<ReflectionAttribute\\<object\\>\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$argumentAttributes of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerAutowiringExtensionInterface\\:\\:supportsConstructorInjectionFor\\(\\) expects list\\<Attribute\\>, list\\<ReflectionAttribute\\<object\\>\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$class of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerAutowiringExtensionInterface\\:\\:injectConstructorArgument\\(\\) expects class\\-string, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$class of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerAutowiringExtensionInterface\\:\\:supportsConstructorInjectionFor\\(\\) expects class\\-string, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Possibly invalid array key type mixed\\.$#',
	'identifier' => 'offsetAccess.invalidOffset',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Container\\:\\:\\$classMap \\(array\\<class\\-string, list\\<string\\>\\>\\) does not accept non\\-empty\\-array\\<string, list\\<string\\>\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Container\\:\\:\\$instances \\(list\\<object\\>\\) does not accept non\\-empty\\-array\\<int\\<0, max\\>\\|string, object\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Container\\:\\:\\$serviceProviders \\(array\\<Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\>\\) does not accept array\\<object\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Container/Container.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Exception\\\\ServiceNotFoundException\\:\\:__construct\\(\\) has parameter \\$resolvingChain with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Exception/ServiceNotFoundException.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Exception\\\\ServiceNotFoundException\\:\\:getResolvingChain\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Exception/ServiceNotFoundException.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\ParameterStore\\:\\:__construct\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ParameterStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\ParameterStore\\:\\:get\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ParameterStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\ParameterStore\\:\\:set\\(\\) has parameter \\$value with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ParameterStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\ParameterStore\\:\\:\\$parameters \\(array\\<string, array\\|bool\\|int\\|string\\>\\) does not accept array\\<string, mixed\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ParameterStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\ServiceProvider\\\\DefaultConfigProviderInterface\\:\\:getDefaultConfig\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceProvider/DefaultConfigProviderInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\ServiceProviderResolver\\:\\:resolveServiceProvidersOrder\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceProviderResolver.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\Dashboard\\\\ObjectOperation\\\\Result\\:\\:__construct\\(\\) has parameter \\$messages with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/Dashboard/ObjectOperation/Result.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\Dashboard\\\\ObjectOperation\\\\Result\\:\\:getMessages\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/Dashboard/ObjectOperation/Result.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:__construct\\(\\) has parameter \\$tags with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:setTags\\(\\) has parameter \\$tags with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$autowired of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$className of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects class\\-string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$factory of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects Closure\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$lazy of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$private of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$shared of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$tags of class Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:\\$autowired is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Contracts\\\\DependencyInjection\\\\Definition\\:\\:\\$lazy is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/Definition.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceProviderInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceProviderInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\ErrorHandler\\\\ErrorHandlerInterface\\:\\:registerErrorHandler\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/ErrorHandler/ErrorHandlerInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\ErrorHandler\\\\ErrorHandlerInterface\\:\\:registerExceptionHandler\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/ErrorHandler/ErrorHandlerInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:generateRoute\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:log\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:render\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:createForm\\(\\) has parameter \\$options with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:createRedirectToRouteResponse\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:generateRoute\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:generateRoute\\(\\) should return string but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:get\\(\\) has parameter \\$id with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:getFormFactory\\(\\) should return Symfony\\\\Component\\\\Form\\\\FormFactory but returns object\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:getRequest\\(\\) should return Symfony\\\\Component\\\\HttpFoundation\\\\Request but returns object\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:log\\(\\) has parameter \\$context with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:log\\(\\) has parameter \\$level with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:log\\(\\) has parameter \\$message with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:renderTemplate\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:renderTemplate\\(\\) should return string but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:url\\(\\) has parameter \\$name with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:url\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:url\\(\\) should return string but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\Container\\:\\:get\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Core\\\\AbstractController\\:\\:\\$container \\(Jadob\\\\Container\\\\Container\\) does not accept Psr\\\\Container\\\\ContainerInterface\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Router\\\\Route\\:\\:getParams\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Controller/StaticPageController.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'template_name\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Controller/StaticPageController.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$templateName of method Jadob\\\\Core\\\\AbstractController\\:\\:renderTemplate\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Controller/StaticPageController.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Core\\\\RequestContext\\:\\:getUser\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Security\\\\Auth\\\\User\\\\UserInterface not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Dispatcher\\:\\:matchRequestObject\\(\\) should return Symfony\\\\Component\\\\HttpFoundation\\\\Request\\|null but returns Jadob\\\\Core\\\\RequestContext\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Dispatcher\\:\\:matchRequestObject\\(\\) should return Symfony\\\\Component\\\\HttpFoundation\\\\Request\\|null but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Dispatcher\\:\\:resolveControllerMethodArguments\\(\\) has parameter \\$routerParams with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Dispatcher\\:\\:resolveControllerMethodArguments\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type Jadob\\\\Container\\\\Exception\\\\AutowiringException\\|Jadob\\\\Container\\\\Exception\\\\ContainerException\\|Jadob\\\\Container\\\\Exception\\\\ServiceNotFoundException\\|ReflectionException is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type Jadob\\\\Container\\\\Exception\\\\AutowiringException\\|Jadob\\\\Container\\\\Exception\\\\ServiceNotFoundException\\|Jadob\\\\Core\\\\Exception\\\\KernelException\\|Jadob\\\\Router\\\\Exception\\\\MethodNotAllowedException\\|Jadob\\\\Router\\\\Exception\\\\RouteNotFoundException\\|ReflectionException is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type Jadob\\\\Container\\\\Exception\\\\AutowiringException\\|Jadob\\\\Container\\\\Exception\\\\ServiceNotFoundException\\|Jadob\\\\Core\\\\Exception\\\\KernelException\\|ReflectionException is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$controllerClassName of method Jadob\\\\Core\\\\Dispatcher\\:\\:autowireControllerClass\\(\\) expects class\\-string, array\\|object\\|string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$haystack of function in_array expects array, array\\<string, class\\-string\\>\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, array\\|object\\|string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\!\\=\\= between ReflectionNamedType and null will always evaluate to true\\.$#',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\!\\=\\= between Symfony\\\\Component\\\\HttpFoundation\\\\Response and null will always evaluate to true\\.$#',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\!\\=\\= between object and null will always evaluate to true\\.$#',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\=\\=\\= between ReflectionNamedType and null will always evaluate to false\\.$#',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\=\\=\\= between array\\|object\\|string and null will always evaluate to false\\.$#',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Unreachable statement \\- code above always terminates\\.$#',
	'identifier' => 'deadCode.unreachable',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Event\\\\AfterControllerEvent\\:\\:getContext\\(\\) should return Jadob\\\\Core\\\\RequestContext but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Event/AfterControllerEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Core\\\\Event\\\\AfterControllerEvent\\:\\:\\$context has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Event/AfterControllerEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Core\\\\Kernel\\:\\:\\$config\\.$#',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Core\\\\Kernel\\:\\:\\$containerBuilder\\.$#',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Core\\\\Kernel\\:\\:\\$deferLogs\\.$#',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Core\\\\Kernel\\:\\:\\$fileStreamHandler\\.$#',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Core\\\\Kernel\\:\\:\\$logger\\.$#',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Core\\\\Kernel\\:\\:\\$psr7Compliant\\.$#',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:create\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:withHandler\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method add\\(\\) on an unknown class Jadob\\\\Container\\\\ContainerBuilder\\.$#',
	'identifier' => 'class.notFound',
	'count' => 8,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method setServiceProviders\\(\\) on an unknown class Jadob\\\\Container\\\\ContainerBuilder\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor invoked with 2 parameters, 3\\-5 required\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Container\\\\ContainerBuilder not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Container\\\\ContainerEventListener not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Kernel\\:\\:getConfig\\(\\) should return Jadob\\\\Config\\\\Config but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Kernel\\:\\:getContainerBuilder\\(\\) has invalid return type Jadob\\\\Container\\\\ContainerBuilder\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Kernel\\:\\:getContainerBuilder\\(\\) should return Jadob\\\\Container\\\\ContainerBuilder but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Kernel\\:\\:initializeLogger\\(\\) should return Psr\\\\Log\\\\LoggerInterface but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\Kernel\\:\\:isPsr7Compliant\\(\\) should return bool but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$bootstrap of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects Jadob\\\\Core\\\\BootstrapInterface, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$defaultLoggerChannel of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Core\\\\Kernel\\:\\:\\$container \\(Jadob\\\\Container\\\\Container\\) does not accept Psr\\\\Container\\\\ContainerInterface\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Core\\\\Kernel\\:\\:\\$loggerFactory is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Undefined variable\\: \\$serviceProviders$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Undefined variable\\: \\$services$#',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Kernel.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\RequestContextStore\\:\\:latest\\(\\) should return Jadob\\\\Core\\\\RequestContext but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/RequestContextStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\RequestContextStore\\:\\:push\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/RequestContextStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Core\\\\RequestContextStore\\:\\:\\$stack type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/RequestContextStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Implicit array creation is not allowed \\- variable \\$context does not exist\\.$#',
	'identifier' => 'variable.implicitArray',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/DevelopmentErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Debug\\\\ErrorHandler\\\\DevelopmentErrorHandler\\:\\:getVariableType\\(\\) has parameter \\$variable with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/DevelopmentErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Debug\\\\ErrorHandler\\\\DevelopmentErrorHandler\\:\\:parseParams\\(\\) has parameter \\$params with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/DevelopmentErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function set_error_handler expects \\(callable\\(int, string, string, int\\)\\: bool\\)\\|null, Closure\\(mixed, mixed, mixed, mixed\\)\\: void given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/DevelopmentErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method critical\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/ProductionErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method warning\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/ProductionErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Implicit array creation is not allowed \\- variable \\$context does not exist\\.$#',
	'identifier' => 'variable.implicitArray',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/ProductionErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function set_error_handler expects \\(callable\\(int, string, string, int\\)\\: bool\\)\\|null, Closure\\(mixed, mixed, mixed, mixed\\)\\: void given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/ProductionErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Debug\\\\ErrorHandler\\\\ProductionErrorHandler\\:\\:\\$logger has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/ErrorHandler/ProductionErrorHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between mixed and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between string and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'args\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'class\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'file\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'function\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'line\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'type\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getCode\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getFile\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getLine\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getMessage\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getTrace\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var has invalid value \\(\\$exception Exception\\)\\: Unexpected token "\\$exception", expected type at offset 9 on line 1$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$object of function get_class expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$string of function strlen expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$value of function count expects array\\|Countable, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\(mixed\\) of echo cannot be converted to string\\.$#',
	'identifier' => 'echo.nonString',
	'count' => 7,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$exception might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 8,
	'path' => __DIR__ . '/../../src/Jadob/Debug/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventDispatcher\\\\EventDispatcher\\:\\:log\\(\\) has parameter \\$context with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventDispatcher/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$value of function count expects array\\|Countable, iterable given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventDispatcher/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Trying to invoke mixed but it\'s not a callable\\.$#',
	'identifier' => 'callable.nonCallable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventDispatcher/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventDispatcher\\\\Exception\\\\EventDispatcherException\\:\\:negativeListenerPriority\\(\\) should return static\\(Jadob\\\\EventDispatcher\\\\Exception\\\\EventDispatcherException\\) but returns Jadob\\\\EventDispatcher\\\\Exception\\\\EventDispatcherException\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventDispatcher/Exception/EventDispatcherException.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Doctrine\\\\DBAL\\\\Driver\\\\Connection\\:\\:createQueryBuilder\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Doctrine\\\\DBAL\\\\Driver\\\\Connection\\:\\:insert\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Aggregate\\\\AggregateRootInterface\\:\\:getCreatedAt\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Aggregate\\\\AggregateRootInterface\\:\\:popUncomittedEvents\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method aggregateTableExists\\(\\) on an unknown class Jadob\\\\EventStore\\\\DBALConnectionUtility\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method createAggregateTable\\(\\) on an unknown class Jadob\\\\EventStore\\\\DBALConnectionUtility\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method createMetadataTable\\(\\) on an unknown class Jadob\\\\EventStore\\\\DBALConnectionUtility\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method dispatch\\(\\) on an unknown class Prooph\\\\ServiceBus\\\\CommandBus\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method metadataTableExists\\(\\) on an unknown class Jadob\\\\EventStore\\\\DBALConnectionUtility\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access constant class on mixed\\.$#',
	'identifier' => 'classConstant.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method execute\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method fetchAll\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method from\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getAggregateVersion\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method orderBy\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method recordedAt\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method select\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method setParameter\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method toArray\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method where\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\EventStore\\\\DbalConnectionUtility not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\DbalEventStore\\:\\:getAggregateMetadata\\(\\) has invalid return type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\DbalEventStore\\:\\:getEventsByAggregateId\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\DbalEventStore\\:\\:getStream\\(\\) should return array\\<Jadob\\\\Aggregate\\\\AbstractDomainEvent\\> but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type Doctrine\\\\DBAL\\\\DBALException is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type Doctrine\\\\DBAL\\\\DBALException\\|Jadob\\\\EventStore\\\\Exception\\\\EventStoreException\\|JsonException is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$dateTime of method Jadob\\\\EventStore\\\\DbalEventStore\\:\\:dateTimeToTimestamp\\(\\) expects DateTimeInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$payload of method Jadob\\\\EventStore\\\\PayloadSerializer\\:\\:serialize\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$value of function count expects array\\|Countable, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$commandBus of method Jadob\\\\EventStore\\\\DbalEventStore\\:\\:__construct\\(\\) has invalid type Prooph\\\\ServiceBus\\\\CommandBus\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$metadata of method Jadob\\\\EventStore\\\\DbalEventStore\\:\\:saveAggregateMetadata\\(\\) has invalid type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\EventStore\\\\DbalEventStore\\:\\:\\$commandBus has unknown class Prooph\\\\ServiceBus\\\\CommandBus as its type\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\EventStore\\\\DbalEventStore\\:\\:\\$utility \\(Jadob\\\\EventStore\\\\DBALConnectionUtility\\) does not accept Jadob\\\\EventStore\\\\DbalConnectionUtility\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\EventStore\\\\DbalEventStore\\:\\:\\$utility has unknown class Jadob\\\\EventStore\\\\DBALConnectionUtility as its type\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DbalEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Aggregate\\\\AggregateRootInterface\\:\\:getCreatedAt\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Aggregate\\\\AggregateRootInterface\\:\\:popUncomittedEvents\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method dispatch\\(\\) on an unknown class Jadob\\\\MessageBus\\\\ServiceBus\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method getAggregateId\\(\\) on an unknown class Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method getAggregateType\\(\\) on an unknown class Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method getCreatedAt\\(\\) on an unknown class Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method createFromMilliseconds\\(\\) on an unknown class Jadob\\\\EventStore\\\\DateTimeFactory\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access constant class on mixed\\.$#',
	'identifier' => 'classConstant.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'aid\' on array\\|stdClass\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'aty\' on array\\|stdClass\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'tme\' on array\\|stdClass\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getAggregateVersion\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getAttributes\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getEventId\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method recordedAt\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method toArray\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\EventStore\\\\AggregateMetadata not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Invalid type mixed to throw\\.$#',
	'identifier' => 'throw.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\DynamoDbEventStore\\:\\:getAggregateMetadata\\(\\) has invalid return type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\DynamoDbEventStore\\:\\:getEventsByAggregateId\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of method Aws\\\\DynamoDb\\\\Marshaler\\:\\:unmarshalItem\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$dateTime of method Jadob\\\\EventStore\\\\DynamoDbEventStore\\:\\:dateTimeToTimestamp\\(\\) expects DateTimeInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$event of method Jadob\\\\EventStore\\\\ExtensionManager\\:\\:dispatchOnEventAppend\\(\\) expects Jadob\\\\Aggregate\\\\DomainEventInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$payload of method Jadob\\\\EventStore\\\\PayloadSerializer\\:\\:serialize\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$value of function count expects array\\|Countable, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$commandBus of method Jadob\\\\EventStore\\\\DynamoDbEventStore\\:\\:__construct\\(\\) has invalid type Jadob\\\\MessageBus\\\\ServiceBus\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$metadata of method Jadob\\\\EventStore\\\\DynamoDbEventStore\\:\\:saveAggregateMetadata\\(\\) has invalid type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\EventStore\\\\DynamoDbEventStore\\:\\:\\$commandBus has unknown class Jadob\\\\MessageBus\\\\ServiceBus as its type\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/DynamoDbEventStore.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method ReflectionType\\:\\:isBuiltin\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access an offset on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$name on ReflectionClass\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getClass\\(\\) on ReflectionParameter\\|false\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getType\\(\\) on ReflectionParameter\\|false\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$objectOrClass of class ReflectionClass constructor expects class\\-string\\<T of object\\>\\|T of object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\EventStore\\\\EventDispatcher\\:\\:\\$listeners has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable method call on mixed\\.$#',
	'identifier' => 'method.dynamicName',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventDispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$metadata of method Jadob\\\\EventStore\\\\EventStoreExtensionInterface\\:\\:onAggregateCreate\\(\\) has invalid type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventStoreExtensionInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\EventStoreInterface\\:\\:getAggregateMetadata\\(\\) has invalid return type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventStoreInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\EventStoreInterface\\:\\:getEventsByAggregateId\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventStoreInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$metadata of method Jadob\\\\EventStore\\\\EventStoreInterface\\:\\:saveAggregateMetadata\\(\\) has invalid type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/EventStoreInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\Exception\\\\AggregateMetadataNotFoundException\\:\\:for\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Exception/AggregateMetadataNotFoundException.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$metadata of method Jadob\\\\EventStore\\\\Extension\\\\EventHashExtension\\:\\:onAggregateCreate\\(\\) has invalid type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Extension/EventHashExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\ExtensionManager\\:\\:dispatchOnAggregateCreate\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/ExtensionManager.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\ExtensionManager\\:\\:dispatchOnEventAppend\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/ExtensionManager.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$metadata of method Jadob\\\\EventStore\\\\ExtensionManager\\:\\:dispatchOnAggregateCreate\\(\\) has invalid type Jadob\\\\EventStore\\\\AggregateMetadata\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/ExtensionManager.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\PayloadSerializer\\:\\:deserialize\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/PayloadSerializer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\PayloadSerializer\\:\\:serialize\\(\\) has parameter \\$payload with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/PayloadSerializer.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Doctrine\\\\DBAL\\\\Connection\\:\\:getSchemaManager\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method createTable\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method tablesExist\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\EventStore\\\\DbalEventStore referenced with incorrect case\\: Jadob\\\\EventStore\\\\DBALEventStore\\.$#',
	'identifier' => 'class.nameCase',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\Storage\\\\DBALConnectionUtility\\:\\:aggregateTableExists\\(\\) should return bool but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\EventStore\\\\Storage\\\\DBALConnectionUtility\\:\\:metadataTableExists\\(\\) should return bool but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @throws with type Doctrine\\\\DBAL\\\\DBALException is not subtype of Throwable$#',
	'identifier' => 'throws.notThrowable',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\EventStore\\\\Storage\\\\DBALConnectionUtility\\:\\:\\$metadataTableExists \\(bool\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALConnectionUtility.php',
];
$ignoreErrors[] = [
	'message' => '#^Constructor of class Jadob\\\\EventStore\\\\Storage\\\\DBALEventStorage has an unused parameter \\$config\\.$#',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/EventStore/Storage/DBALEventStorage.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 6,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method object\\:\\:getDefaultLogger\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getAutowiringExtensions\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getContainerExtensionProviders\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getContainerExtensions\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getEventListeners\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getServiceProviders\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Framework\\\\Application has an uninitialized readonly property \\$container\\. Assign it in the constructor\\.$#',
	'identifier' => 'property.uninitializedReadonly',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:__construct\\(\\) has parameter \\$modules with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:__construct\\(\\) has parameter \\$serviceProviders with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getConsole\\(\\) should return Symfony\\\\Component\\\\Console\\\\Application but returns object\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getLoggerFactory\\(\\) should return Jadob\\\\Framework\\\\Logger\\\\LoggerFactory but returns object\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getRouter\\(\\) is unused\\.$#',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getRouter\\(\\) should return Jadob\\\\Router\\\\Router but returns object\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var for variable \\$services has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$extension of method Jadob\\\\Container\\\\Container\\:\\:addAutowiringExtension\\(\\) expects Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerAutowiringExtensionInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$extension of method Jadob\\\\Container\\\\Container\\:\\:addExtension\\(\\) expects Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerExtensionInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$parameters of class Jadob\\\\Container\\\\ParameterStore constructor expects array\\<string, array\\|bool\\|int\\|string\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$provider of method Jadob\\\\EventDispatcher\\\\EventDispatcher\\:\\:addListener\\(\\) expects Psr\\\\EventDispatcher\\\\ListenerProviderInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serviceProvider of method Jadob\\\\Container\\\\Container\\:\\:registerServiceProvider\\(\\) expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$service of method Jadob\\\\Container\\\\Container\\:\\:add\\(\\) expects array\\|object\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$eventDispatcher of class Jadob\\\\Core\\\\Dispatcher constructor expects Psr\\\\EventDispatcher\\\\EventDispatcherInterface, object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Readonly property Jadob\\\\Framework\\\\Application\\:\\:\\$container is assigned outside of the constructor\\.$#',
	'identifier' => 'property.readOnlyAssignNotInConstructor',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$requestId on left side of \\?\\? is never defined\\.$#',
	'identifier' => 'nullCoalesce.variable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Symfony\\\\Component\\\\Console\\\\Application\\:\\:add\\(\\)\\.$#',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/Extension/ConsoleCommandExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function method_exists\\(\\) with Symfony\\\\Component\\\\Console\\\\Application and \'addCommand\' will always evaluate to true\\.$#',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/Extension/ConsoleCommandExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$provider of method Jadob\\\\EventDispatcher\\\\EventDispatcher\\:\\:addListener\\(\\) expects Psr\\\\EventDispatcher\\\\ListenerProviderInterface, object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/Extension/EventDispatcherExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\DependencyInjection\\\\ExtensionProvider\\\\FrameworkContainerExtensionProvider\\:\\:getAutowiringExtensions\\(\\) should return list\\<Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerAutowiringExtensionInterface\\> but returns array\\{mixed\\}\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/ExtensionProvider/FrameworkContainerExtensionProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\DevelopmentExceptionListener\\:\\:getVariableType\\(\\) has parameter \\$variable with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/DevelopmentExceptionListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\DevelopmentExceptionListener\\:\\:parseParams\\(\\) has parameter \\$params with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/DevelopmentExceptionListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$content of class Symfony\\\\Component\\\\HttpFoundation\\\\Response constructor expects string\\|null, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/DevelopmentExceptionListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$message of method Psr\\\\Log\\\\LoggerInterface\\:\\:critical\\(\\) expects string, Throwable given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/DevelopmentExceptionListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$subject of function str_replace expects array\\<string\\>\\|string, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/DevelopmentExceptionListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\ExceptionHandler\\:\\:handleError\\(\\) has parameter \\$errfile with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\ExceptionHandler\\:\\:handleError\\(\\) has parameter \\$errline with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\ExceptionHandler\\:\\:handleError\\(\\) has parameter \\$errno with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\ExceptionHandler\\:\\:handleError\\(\\) has parameter \\$errstr with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ErrorHandler\\\\ExceptionHandler\\:\\:handleException\\(\\) should return Symfony\\\\Component\\\\HttpFoundation\\\\Response but returns Symfony\\\\Component\\\\HttpFoundation\\\\Response\\|null\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function set_error_handler expects \\(callable\\(int, string, string, int\\)\\: bool\\)\\|null, Closure\\(mixed, mixed, mixed, mixed\\)\\: void given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function set_exception_handler expects \\(callable\\(Throwable\\)\\: void\\)\\|null, Closure\\(Throwable\\)\\: Symfony\\\\Component\\\\HttpFoundation\\\\Response given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$message of class ErrorException constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$code of class ErrorException constructor expects int, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$severity of class ErrorException constructor expects int, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#4 \\$filename of class ErrorException constructor expects string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#5 \\$line of class ErrorException constructor expects int\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ExceptionHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$message of method Psr\\\\Log\\\\LoggerInterface\\:\\:critical\\(\\) expects string, Throwable given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/ProductionExceptionListener.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between mixed and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between string and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'args\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'class\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'file\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'function\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'line\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'type\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getCode\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getException\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getFile\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getLine\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getMessage\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getTrace\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var has invalid value \\(\\$event \\\\Jadob\\\\Framework\\\\Event\\\\ExceptionEvent\\)\\: Unexpected token "\\$event", expected type at offset 12 on line 2$#',
	'identifier' => 'phpDoc.parseError',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$object of function get_class expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$string of function strlen expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$value of function count expects array\\|Countable, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\(mixed\\) of echo cannot be converted to string\\.$#',
	'identifier' => 'echo.nonString',
	'count' => 7,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable \\$event might not be defined\\.$#',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ErrorHandler/templates/error_view.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Event\\\\ExceptionEvent\\:\\:isPropagationStopped\\(\\) should return bool but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Event/ExceptionEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Framework\\\\Event\\\\ExceptionEvent\\:\\:\\$stopped has no type specified\\.$#',
	'identifier' => 'missingType.property',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Event/ExceptionEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method getCurrentHub\\(\\) on an unknown class Sentry\\\\SentrySdk\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'level\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'path\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'rotating\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'type\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Sentry\\\\Monolog\\\\BreadcrumbHandler not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Sentry\\\\Monolog\\\\Handler not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:__construct\\(\\) has parameter \\$channelsConfig with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:__construct\\(\\) has parameter \\$handlersConfig with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:getOrCreateHandler\\(\\) should return Monolog\\\\Handler\\\\HandlerInterface but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:getOrCreateLogger\\(\\) should return Psr\\\\Log\\\\LoggerInterface but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Negated boolean expression is always true\\.$#',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in a negated boolean, array\\|float\\|int\\|string\\|false\\|null given\\.$#',
	'identifier' => 'booleanNot.exprNotBoolean',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$handlerName of method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:getOrCreateHandler\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$handlers of class Monolog\\\\Handler\\\\GroupHandler constructor expects array\\<Monolog\\\\Handler\\\\HandlerInterface\\>, array\\<int, Sentry\\\\Monolog\\\\BreadcrumbHandler\\|Sentry\\\\Monolog\\\\Handler\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$path of method Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:resolvePath\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$level of class Monolog\\\\Handler\\\\RotatingFileHandler constructor expects 100\\|200\\|250\\|300\\|400\\|500\\|550\\|600\\|\'ALERT\'\\|\'alert\'\\|\'CRITICAL\'\\|\'critical\'\\|\'DEBUG\'\\|\'debug\'\\|\'EMERGENCY\'\\|\'emergency\'\\|\'ERROR\'\\|\'error\'\\|\'INFO\'\\|\'info\'\\|\'NOTICE\'\\|\'notice\'\\|\'WARNING\'\\|\'warning\', mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$level of class Monolog\\\\Handler\\\\StreamHandler constructor expects 100\\|200\\|250\\|300\\|400\\|500\\|550\\|600\\|\'ALERT\'\\|\'alert\'\\|\'CRITICAL\'\\|\'critical\'\\|\'DEBUG\'\\|\'debug\'\\|\'EMERGENCY\'\\|\'emergency\'\\|\'ERROR\'\\|\'error\'\\|\'INFO\'\\|\'info\'\\|\'NOTICE\'\\|\'notice\'\\|\'WARNING\'\\|\'warning\', mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:\\$handlers type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:\\$loggers type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/LoggerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\ConsoleProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/ConsoleProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\ConsoleProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/ConsoleProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\) of method Jadob\\\\Framework\\\\ServiceProvider\\\\ConsoleProvider\\:\\:register\\(\\) should be covariant with return type \\(array\\<string, array\\|object\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/ConsoleProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\CsrfProvider\\:\\:onContainerBuild\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/CsrfProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\CsrfProvider\\:\\:onContainerBuild\\(\\) has parameter \\$config with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/CsrfProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$requestStack of class Symfony\\\\Component\\\\Security\\\\Csrf\\\\TokenStorage\\\\SessionTokenStorage constructor expects Symfony\\\\Component\\\\HttpFoundation\\\\RequestStack, object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/CsrfProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$tokenManager of class Symfony\\\\Component\\\\Form\\\\Extension\\\\Csrf\\\\CsrfExtension constructor expects Symfony\\\\Component\\\\Security\\\\Csrf\\\\CsrfTokenManagerInterface, object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/CsrfProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\Bridge\\\\Jadob\\\\JadobUrlGenerator\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\Component\\\\BigNumberComponent\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\Component\\\\ComponentProcessor\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\Configuration\\\\DashboardConfiguration\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\ObjectManager\\\\DoctrineOrmObjectManager\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\OperationHandler\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has invalid return type Jadob\\\\Dashboard\\\\PathGenerator\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Jadob\\\\Dashboard\\\\Configuration\\\\DashboardConfiguration but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to static method fromArray\\(\\) on an unknown class Jadob\\\\Dashboard\\\\Configuration\\\\DashboardConfiguration\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\Component\\\\BigNumberComponent not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\Component\\\\ComponentProcessor not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\Configuration\\\\DashboardConfiguration not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\ObjectManager\\\\DoctrineOrmObjectManager not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\OperationHandler not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\PathGenerator not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Dashboard\\\\UrlGeneratorInterface not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\Bridge\\\\Jadob\\\\JadobUrlGenerator not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\Component\\\\BigNumberComponent not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\Component\\\\ComponentProcessor not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\ObjectManager\\\\DoctrineOrmObjectManager not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\OperationHandler not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\PathGenerator not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\Twig\\\\DashboardConfigurationExtension not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\Twig\\\\DashboardExtension not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\Dashboard\\\\Twig\\\\DashboardRoutingExtension not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\DashboardProvider\\:\\:onContainerBuild\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\DashboardProvider\\:\\:onContainerBuild\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\DashboardProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$extension of method Twig\\\\Environment\\:\\:addExtension\\(\\) expects Twig\\\\Extension\\\\ExtensionInterface, Jadob\\\\Dashboard\\\\Twig\\\\DashboardConfigurationExtension given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$extension of method Twig\\\\Environment\\:\\:addExtension\\(\\) expects Twig\\\\Extension\\\\ExtensionInterface, Jadob\\\\Dashboard\\\\Twig\\\\DashboardExtension given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$extension of method Twig\\\\Environment\\:\\:addExtension\\(\\) expects Twig\\\\Extension\\\\ExtensionInterface, Jadob\\\\Dashboard\\\\Twig\\\\DashboardRoutingExtension given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/DashboardProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\ErrorHandlerServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/ErrorHandlerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\ErrorHandlerServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/ErrorHandlerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\EventDispatcherProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventDispatcherProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\EventDispatcherProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventDispatcherProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between \'doctrine\\.dbal\\.\' and mixed results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Binary operation "\\." between mixed and \'/event_store\\.log\' results in an error\\.$#',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to method addProjection\\(\\) on an unknown class Jadob\\\\EventStore\\\\ProjectionManager\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'connection_name\' on Psr\\\\Container\\\\ContainerInterface\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getLogsDir\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\EventStore\\\\DbalEventStore constructor invoked with 4 parameters, 3 required\\.$#',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\EventStore\\\\DbalEventStore referenced with incorrect case\\: Jadob\\\\EventStore\\\\DBALEventStore\\.$#',
	'identifier' => 'class.nameCase',
	'count' => 3,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\EventStore\\\\ProjectionManager not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Instantiated class Jadob\\\\EventStore\\\\ProjectionManager not found\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\EventStoreProvider\\:\\:onContainerBuild\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\EventStoreProvider\\:\\:onContainerBuild\\(\\) has parameter \\$config with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\EventStoreProvider\\:\\:register\\(\\) has invalid return type Jadob\\\\EventStore\\\\ProjectionManager\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\EventStoreProvider\\:\\:register\\(\\) should return array\\{Jadob\\\\EventSourcing\\\\EventStore\\\\ProjectionManager\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Jadob\\\\EventStore\\\\ProjectionManager, Jadob\\\\EventSourcing\\\\EventStore\\\\EventDispatcher\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Jadob\\\\EventStore\\\\EventDispatcher, Jadob\\\\EventSourcing\\\\EventStore\\\\EventStoreInterface\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Jadob\\\\EventStore\\\\DBALEventStore\\} but returns array\\{Jadob\\\\EventStore\\\\ProjectionManager\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Jadob\\\\EventStore\\\\ProjectionManager, Jadob\\\\EventStore\\\\EventDispatcher\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Jadob\\\\EventStore\\\\EventDispatcher, Jadob\\\\EventStore\\\\EventStoreInterface\\: Closure\\(Psr\\\\Container\\\\ContainerInterface\\)\\: Jadob\\\\EventStore\\\\DBALEventStore\\}\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$connection of class Jadob\\\\EventStore\\\\DbalEventStore constructor expects Doctrine\\\\DBAL\\\\Driver\\\\Connection, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Psr\\\\Container\\\\ContainerInterface\\:\\:get\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$logger of class Jadob\\\\EventStore\\\\DbalEventStore constructor expects Psr\\\\Log\\\\LoggerInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$commandBus of class Jadob\\\\EventStore\\\\DbalEventStore constructor expects Prooph\\\\ServiceBus\\\\CommandBus, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/EventStoreProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\FrameworkServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/FrameworkServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\FrameworkServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/FrameworkServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'channels\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'default_error_logger_channel\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'default_logger_channel\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'handlers\' on array\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$channelsConfig of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$defaultErrorLoggerChannel of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$defaultLoggerChannel of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$handlersConfig of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\MessageBusServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/MessageBusServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\MessageBusServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/MessageBusServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\SessionProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SessionProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\SessionProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SessionProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type list\\<string\\>\\|false supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'domain\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'locale\' on array\\{locale\\: string, logging\\: bool\\}\\|object\\|null\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'locale\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'logging\' on array\\{locale\\: string, logging\\: bool\\}\\|object\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'path\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'sources\' on array\\{locale\\: string, logging\\: bool\\}\\|object\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$locale of class Symfony\\\\Component\\\\Translation\\\\Translator constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$path of class Jadob\\\\Bridge\\\\Symfony\\\\Translation\\\\TranslationSource constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$config \\(array\\{locale\\: string, logging\\: bool\\}\\|object\\|null\\) of method Jadob\\\\Framework\\\\ServiceProvider\\\\SymfonyTranslatorProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(array\\|object\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$formatter of class Symfony\\\\Component\\\\Translation\\\\Translator constructor expects Symfony\\\\Component\\\\Translation\\\\Formatter\\\\MessageFormatterInterface\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$locale of class Jadob\\\\Bridge\\\\Symfony\\\\Translation\\\\TranslationSource constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$domain of class Jadob\\\\Bridge\\\\Symfony\\\\Translation\\\\TranslationSource constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\<string, \\(callable\\(\\)\\: mixed\\)\\|object\\>\\) of method Jadob\\\\Framework\\\\ServiceProvider\\\\SymfonyTranslatorProvider\\:\\:register\\(\\) should be covariant with return type \\(array\\<string, array\\|object\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getName\\(\\) on ReflectionType\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ReflectionMessageBus.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\MessageBus\\\\ReflectionMessageBus\\:\\:__construct\\(\\) has parameter \\$handlers with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ReflectionMessageBus.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$objectOrClass of class ReflectionClass constructor expects class\\-string\\<T of object\\>\\|T of object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ReflectionMessageBus.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable method call on mixed\\.$#',
	'identifier' => 'method.dynamicName',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ReflectionMessageBus.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\MessageBus\\\\ServiceProvider\\\\MessageBusServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ServiceProvider/MessageBusServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\MessageBus\\\\ServiceProvider\\\\MessageBusServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ServiceProvider/MessageBusServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\<array\\|object\\>\\) of method Jadob\\\\MessageBus\\\\ServiceProvider\\\\MessageBusServiceProvider\\:\\:register\\(\\) should be covariant with return type \\(array\\<string, array\\|object\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/MessageBus/ServiceProvider/MessageBusServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\Annotation\\\\Field\\:\\:__construct\\(\\) has parameter \\$context with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/Annotation/Field.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\Annotation\\\\Field\\:\\:getContext\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/Annotation/Field.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\Annotation\\\\Translate\\:\\:__construct\\(\\) has parameter \\$context with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/Annotation/Translate.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\Annotation\\\\Translate\\:\\:getContext\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/Annotation/Translate.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot cast mixed to string\\.$#',
	'identifier' => 'cast.string',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Comparison operation "\\>" between int\\<2, max\\> and 1 is always true\\.$#',
	'identifier' => 'greater.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\ItemProcessor\\:\\:__construct\\(\\) has parameter \\$itemTransformers with no value type specified in iterable type iterable\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\ItemProcessor\\:\\:extractItemValues\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$item of method Jadob\\\\Objectable\\\\ItemProcessor\\:\\:extractItemValues\\(\\) expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$object of function get_class expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Objectable\\\\ItemProcessor\\:\\:\\$itemTransformers \\(array\\<Jadob\\\\Objectable\\\\Transformer\\\\ItemTransformerInterface\\>\\) does not accept array\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Variable method call on object\\.$#',
	'identifier' => 'method.dynamicName',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ItemProcessor.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Objectable\\\\ResultRow\\:\\:\\$actionFields has unknown class Jadob\\\\Objectable\\\\Annotation\\\\ActionField as its type\\.$#',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/ResultRow.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Objectable\\\\Transformer\\\\ItemTransformerInterface\\:\\:process\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Objectable/Transformer/ItemTransformerInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Route\\:\\:__construct\\(\\) has parameter \\$handler with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Route\\:\\:__construct\\(\\) has parameter \\$methods with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Route\\:\\:__construct\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Route\\:\\:__construct\\(\\) has parameter \\$pathParameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Route\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of class Jadob\\\\Router\\\\Route constructor expects non\\-empty\\-string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$path of class Jadob\\\\Router\\\\Route constructor expects non\\-empty\\-string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$handler of class Jadob\\\\Router\\\\Route constructor expects array\\|object\\|string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#4 \\$host of class Jadob\\\\Router\\\\Route constructor expects string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#5 \\$methods of class Jadob\\\\Router\\\\Route constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#6 \\$parameters of class Jadob\\\\Router\\\\Route constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#7 \\$pathParameters of class Jadob\\\\Router\\\\Route constructor expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Route.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function is_string\\(\\) with array will always evaluate to false\\.$#',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\RouteCollection\\:\\:current\\(\\) should return Jadob\\\\Router\\\\Route but returns Jadob\\\\Router\\\\Route\\|false\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\RouteCollection\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\RouteCollection\\:\\:key\\(\\) should return non\\-empty\\-string but returns int\\|string\\|null\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Router\\\\RouteCollection\\:\\:fromArray\\(\\) expects array\\<array\\>, array\\<mixed, mixed\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$host of method Jadob\\\\Router\\\\RouteCollection\\:\\:setHost\\(\\) expects string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$prefix of method Jadob\\\\Router\\\\RouteCollection\\:\\:setPrefix\\(\\) expects string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Possibly invalid array key type string\\|null\\.$#',
	'identifier' => 'offsetAccess.invalidOffset',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Result of && is always false\\.$#',
	'identifier' => 'booleanAnd.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/RouteCollection.php',
];
$ignoreErrors[] = [
	'message' => '#^Access to an undefined property Jadob\\\\Router\\\\Router\\:\\:\\$config\\.$#',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'case_sensitive\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot cast mixed to string\\.$#',
	'identifier' => 'cast.string',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Router\\:\\:extractPathParams\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Router\\:\\:generateRoute\\(\\) has parameter \\$full with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Router\\:\\:generateRoute\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Router\\:\\:pathToExpression\\(\\) has parameter \\$params with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Router\\:\\:transformMatchesToParameters\\(\\) has parameter \\$matches with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\Router\\:\\:transformMatchesToParameters\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in an if condition, bool\\|null given\\.$#',
	'identifier' => 'if.condNotBoolean',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in an if condition, int\\|false given\\.$#',
	'identifier' => 'if.condNotBoolean',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, array\\<mixed, mixed\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$subject of function preg_replace expects array\\<float\\|int\\|string\\>\\|string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$pathParameters of class Jadob\\\\Router\\\\MatchedRoute constructor expects array\\<non\\-empty\\-string, string\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Possibly invalid array key type mixed\\.$#',
	'identifier' => 'offsetAccess.invalidOffset',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Router\\\\Route\\:\\:\\$pathParameters \\(array\\) on left side of \\?\\? is not nullable\\.$#',
	'identifier' => 'nullCoalesce.property',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Router/Router.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'host\' on array\\{scheme\\?\\: string, host\\?\\: string, port\\?\\: int\\<0, 65535\\>, user\\?\\: string, pass\\?\\: string, path\\?\\: string, query\\?\\: string, fragment\\?\\: string\\}\\|false\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'scheme\' on array\\{scheme\\?\\: string, host\\?\\: string, port\\?\\: int\\<0, 65535\\>, user\\?\\: string, pass\\?\\: string, path\\?\\: string, query\\?\\: string, fragment\\?\\: string\\}\\|false\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\ServiceProvider\\\\RouterConfiguration\\:\\:getRoutes\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\ServiceProvider\\\\RouterConfiguration\\:\\:importRoutes\\(\\) has parameter \\$routes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Router\\\\ServiceProvider\\\\RouterConfiguration\\:\\:\\$routes type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\ServiceProvider\\\\RouterServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Router\\\\ServiceProvider\\\\RouterServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Router\\\\RouteCollection\\:\\:fromArray\\(\\) expects array\\<array\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Router/ServiceProvider/RouterServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Aws\\\\Lambda\\\\EventBridgeEvent\\:\\:\\$detail type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Aws/Lambda/EventBridgeEvent.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Geo\\\\HighPrecisionLatitude\\:\\:getValue\\(\\) should return float but returns float\\|string\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Geo/HighPrecisionLatitude.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Geo\\\\HighPrecisionLongitude\\:\\:getValue\\(\\) should return float but returns float\\|string\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Geo/HighPrecisionLongitude.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Geo\\\\Latitude\\:\\:getValue\\(\\) should return float but returns float\\|string\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Geo/Latitude.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Geo\\\\Longitude\\:\\:getValue\\(\\) should return float but returns float\\|string\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Geo/Longitude.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Chat.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:fromArray\\(\\) should return static\\(Jadob\\\\Typed\\\\Telegram\\\\Chat\\) but returns Jadob\\\\Typed\\\\Telegram\\\\Chat\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Chat.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:\\$firstName \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Chat.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:\\$lastName \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Chat.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:\\$type \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Chat.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:\\$username \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Chat.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\File\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/File.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\File\\:\\:\\$fileId \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/File.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\File\\:\\:\\$filePath \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/File.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\File\\:\\:\\$fileSize \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/File.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\File\\:\\:\\$fileUniqueId \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/File.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Left side of && is always false\\.$#',
	'identifier' => 'booleanAnd.leftAlwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Typed\\\\Telegram\\\\Chat\\:\\:fromArray\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Typed\\\\Telegram\\\\MessageEntity\\:\\:fromArray\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:fromArray\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:fromArray\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:\\$date \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:\\$entities type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:\\$id \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:\\$photo type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:\\$text \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\=\\=\\= between \\*NEVER\\* and 0 will always evaluate to false\\.$#',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Message.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\MessageEntity\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/MessageEntity.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\MessageEntity\\:\\:\\$length \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/MessageEntity.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\MessageEntity\\:\\:\\$offset \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/MessageEntity.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\MessageEntity\\:\\:\\$type \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/MessageEntity.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/PhotoSize.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:\\$fileId \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/PhotoSize.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:\\$fileSize \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/PhotoSize.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:\\$fileUniqueId \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/PhotoSize.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:\\$height \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/PhotoSize.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\PhotoSize\\:\\:\\$width \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/PhotoSize.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\Update\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Update.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Typed\\\\Telegram\\\\Message\\:\\:fromArray\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Update.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\Update\\:\\:\\$id \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/Update.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:\\$bot \\(bool\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:\\$firstName \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:\\$id \\(int\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:\\$languageCode \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:\\$lastName \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\User\\:\\:\\$username \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/User.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Typed\\\\Telegram\\\\WebhookInfo\\:\\:fromArray\\(\\) has parameter \\$data with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/WebhookInfo.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Typed\\\\Telegram\\\\WebhookInfo\\:\\:\\$url \\(string\\|null\\) does not accept mixed\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Typed/Telegram/WebhookInfo.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function is_array\\(\\) with array will always evaluate to true\\.$#',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Url/Url.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Url\\\\Url\\:\\:addQueryParameter\\(\\) has parameter \\$value with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Url/Url.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Url\\\\Url\\:\\:getQuery\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Url/Url.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in an if condition, array given\\.$#',
	'identifier' => 'if.condNotBoolean',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Url/Url.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Url\\\\Url\\:\\:\\$query type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Url/Url.php',
];
$ignoreErrors[] = [
	'message' => '#^Result of && is always false\\.$#',
	'identifier' => 'booleanAnd.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Url/Url.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Webhook\\\\Handler\\\\Controller\\\\WebhookAction\\:\\:__invoke\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Handler/Controller/WebhookAction.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Webhook\\\\Handler\\\\Service\\\\ProviderRegistry\\:\\:addProvider\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Handler/Service/ProviderRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Webhook\\\\Handler\\\\Service\\\\ProviderRegistry\\:\\:\\$providers \\(array\\<string, Jadob\\\\Contracts\\\\Webhook\\\\WebhookProviderInterface\\>\\) does not accept array\\<int\\|string, Jadob\\\\Contracts\\\\Webhook\\\\WebhookProviderInterface\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Handler/Service/ProviderRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Handler/Service/RequestHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Webhook\\\\Handler\\\\Service\\\\RequestHandler\\:\\:handle\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Handler/Service/RequestHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Jadob\\\\Webhook\\\\Handler\\\\Service\\\\ProviderRegistry\\:\\:getProvider\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Handler/Service/RequestHandler.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access offset \'update_id\' on mixed\\.$#',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Provider/Telegram/TelegramEventExtractor.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$data of static method Jadob\\\\Typed\\\\Telegram\\\\Update\\:\\:fromArray\\(\\) expects array, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Webhook/Provider/Telegram/TelegramEventExtractor.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$firewalls of class Jadob\\\\Auth\\\\Firewall\\\\FirewallMap constructor expects array\\<Jadob\\\\Auth\\\\Firewall\\\\Firewall\\>, array\\<int, Jadob\\\\Auth\\\\Firewall\\\\FirewallInterface&PHPUnit\\\\Framework\\\\MockObject\\\\MockObject\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Auth/Firewall/FirewallMapTest.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Fixtures\\\\ServiceProviders\\\\NonExistingConfigNodeServiceProvider\\:\\:register\\(\\) has parameter \\$config with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/ServiceProviders/NonExistingConfigNodeServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Fixtures\\\\ServiceProviders\\\\NonExistingConfigNodeServiceProvider\\:\\:register\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/ServiceProviders/NonExistingConfigNodeServiceProvider.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
