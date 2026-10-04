<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Auth\\\\AccessToken\\\\AccessToken\\:\\:__construct\\(\\) has parameter \\$metadata with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/AccessToken/AccessToken.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function is_array\\(\\) with array\\<Jadob\\\\Auth\\\\AccessToken\\\\AccessToken\\> will always evaluate to true\\.$#',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/AccessToken/AccessTokenStorage.php',
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
	'message' => '#^Strict comparison using \\=\\=\\= between array\\<Jadob\\\\Auth\\\\AccessToken\\\\AccessToken\\> and null will always evaluate to false\\.$#',
	'identifier' => 'identical.alwaysFalse',
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
	'message' => '#^Method Jadob\\\\Auth\\\\Firewall\\\\Firewall\\:\\:getIdentityPicker\\(\\) should return Jadob\\\\Auth\\\\Identity\\\\IdentityPickerInterface but returns Jadob\\\\Auth\\\\Identity\\\\IdentityPickerInterface\\|null\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/Firewall/Firewall.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$entryPointServiceId on mixed\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$firewalls on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$identityPickerServiceId on mixed\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$identityProviderServiceId on mixed\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$requestMatcherServiceId on mixed\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getAuthenticators\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method isIdentityStackingEnabled\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method isStateless\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function array_map expects \\(callable\\(mixed\\)\\: mixed\\)\\|null, Closure\\(string\\)\\: mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Psr\\\\Container\\\\ContainerInterface\\:\\:get\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 4,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$array of function array_map expects array, mixed given\\.$#',
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
	'message' => '#^Parameter \\$identityStackingEnabled of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$name of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects string, mixed given\\.$#',
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
	'message' => '#^Parameter \\$stateless of class Jadob\\\\Auth\\\\Firewall\\\\Firewall constructor expects bool, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Possibly invalid array key type mixed\\.$#',
	'identifier' => 'offsetAccess.invalidOffset',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Auth/ServiceProvider/AuthenticationServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Auth\\\\ServiceProvider\\\\FirewallConfig\\:\\:\\$authenticators \\(array\\<class\\-string\\>\\) does not accept array\\<string\\>\\.$#',
	'identifier' => 'assign.propertyType',
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
	'message' => '#^Property Jadob\\\\Bridge\\\\Doctrine\\\\Dbal\\\\Configuration\\\\DbalConfiguration\\:\\:\\$types \\(array\\<string, class\\-string\\>\\) does not accept array\\<string, string\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/Configuration/DbalConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Dbal\\\\Configuration\\\\DbalConnectionConfig\\:\\:withMappingType\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/Configuration/DbalConnectionConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Doctrine\\\\DBAL\\\\Connection but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/ServiceProvider/DoctrineDbalProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$connections on Jadob\\\\Bridge\\\\Doctrine\\\\Dbal\\\\Configuration\\\\DbalConfiguration\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/ServiceProvider/DoctrineDbalProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$types on Jadob\\\\Bridge\\\\Doctrine\\\\Dbal\\\\Configuration\\\\DbalConfiguration\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/ServiceProvider/DoctrineDbalProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var with type array\\<string, string\\> is not subtype of native type null\\.$#',
	'identifier' => 'varTag.nativeType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/ServiceProvider/DoctrineDbalProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$type of static method Doctrine\\\\DBAL\\\\Types\\\\Type\\:\\:addType\\(\\) expects class\\-string\\<Doctrine\\\\DBAL\\\\Types\\\\Type\\>\\|Doctrine\\\\DBAL\\\\Types\\\\Type, class\\-string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/ServiceProvider/DoctrineDbalProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$defaultConnectionName of class Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineConnectionRegistry constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Dbal/ServiceProvider/DoctrineDbalProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$allOrNothing on Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\Configuration\\\\MigrationsConfiguration\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$checkDatabasePlatform on Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\Configuration\\\\MigrationsConfiguration\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$customTemplate on Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\Configuration\\\\MigrationsConfiguration\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$migrationPaths on Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\Configuration\\\\MigrationsConfiguration\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$builder of method Jadob\\\\Bridge\\\\Doctrine\\\\Migrations\\\\ServiceProvider\\\\DoctrineMigrationsProvider\\:\\:registerConsoleCommands\\(\\) expects Jadob\\\\Container\\\\Builder\\\\ContainerBuilder, Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerBuilderInterface given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$path of function dirname expects string, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Migrations/ServiceProvider/DoctrineMigrationsProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\Console\\\\MultipleEntityManagerProvider\\:\\:getDefaultManager\\(\\) should return Doctrine\\\\ORM\\\\EntityManagerInterface but returns Doctrine\\\\Persistence\\\\ObjectManager\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/Console/MultipleEntityManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\Console\\\\MultipleEntityManagerProvider\\:\\:getManager\\(\\) should return Doctrine\\\\ORM\\\\EntityManagerInterface but returns Doctrine\\\\Persistence\\\\ObjectManager\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/Console/MultipleEntityManagerProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ObjectManagerFactoryInterface but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to function is_string\\(\\) with string will always evaluate to true\\.$#',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Class Jadob\\\\Bridge\\\\Doctrine\\\\ORM\\\\Console\\\\MultipleEntityManagerProvider referenced with incorrect case\\: Jadob\\\\Bridge\\\\Doctrine\\\\Orm\\\\Console\\\\MultipleEntityManagerProvider\\.$#',
	'identifier' => 'class.nameCase',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$builder of method Jadob\\\\Bridge\\\\Doctrine\\\\Orm\\\\ServiceProvider\\\\DoctrineOrmProvider\\:\\:registerOrmConsoleCommands\\(\\) expects Jadob\\\\Container\\\\Builder\\\\ContainerBuilder, Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerBuilderInterface given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$path of function dirname expects string, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$conn of class Doctrine\\\\ORM\\\\EntityManager constructor expects Doctrine\\\\DBAL\\\\Connection, object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$connectionRegistry of class Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineManagerRegistry constructor expects Doctrine\\\\Persistence\\\\ConnectionRegistry, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$defaultManagerName of class Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineManagerRegistry constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Return type \\(array\\<class\\-string\\>\\) of method Jadob\\\\Bridge\\\\Doctrine\\\\Orm\\\\ServiceProvider\\\\DoctrineOrmProvider\\:\\:getParentServiceProviders\\(\\) should be covariant with return type \\(list\\<class\\-string\\>\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ParentServiceProviderInterface\\:\\:getParentServiceProviders\\(\\)$#',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Orm/ServiceProvider/DoctrineOrmProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\DoctrineConnectionRegistry\\:\\:getConnectionNames\\(\\) should return array\\<string, string\\> but returns list\\<string\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineConnectionRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Instanceof between Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ObjectManagerFactoryInterface and Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ObjectManagerFactoryInterface will always evaluate to true\\.$#',
	'identifier' => 'instanceof.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistry.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Doctrine\\\\Persistence\\\\ObjectManagerFactory\\:\\:build\\(\\) should return Doctrine\\\\Persistence\\\\ObjectManager but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Doctrine/Persistence/ObjectManagerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$dynamoDbClientId on Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$mappingCacheEnabled on Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$tableConfigs on Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$client of class Dynamite\\\\ItemManager constructor expects Aws\\\\DynamoDb\\\\DynamoDbClient, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$tableName of class Dynamite\\\\TableSchema constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$partitionKeyName of class Dynamite\\\\TableSchema constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$sortKeyName of class Dynamite\\\\TableSchema constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#4 \\$indexes of class Dynamite\\\\TableSchema constructor expects array\\<string, array\\{pk\\: string, sk\\: string\\|null\\}\\>, array\\<non\\-empty\\-string\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Dynamite/ServiceProvider/DynamiteProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Symfony\\\\Form\\\\ServiceProvider\\\\FormsConfig\\:\\:__construct\\(\\) has parameter \\$formThemes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/FormsConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to an undefined method Jadob\\\\Bridge\\\\Symfony\\\\Form\\\\ServiceProvider\\\\FormsConfig\\:\\:getFormThemes\\(\\)\\.$#',
	'identifier' => 'method.notFound',
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
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Configuration\\\\TwigConfig\\:\\:__construct\\(\\) has parameter \\$globals with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Configuration/TwigConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Configuration\\\\TwigConfig\\:\\:__construct\\(\\) has parameter \\$templatePaths with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Configuration/TwigConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serviceId of static method Jadob\\\\Contracts\\\\DependencyInjection\\\\Reference\\:\\:service\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
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
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\TranslationExtension\\:\\:translate\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/TranslationExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$json of function json_decode expects string, string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/WebpackManifestAssetExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$manifest of class Jadob\\\\Bridge\\\\Twig\\\\Extension\\\\WebpackManifestAssetExtension constructor expects array\\<non\\-empty\\-string, non\\-empty\\-string\\>, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/Extension/WebpackManifestAssetExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function has an unused use \\$builder\\.$#',
	'identifier' => 'closure.unusedUse',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$cache on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$globals on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$manifestLocation on mixed\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$strictVariables on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$templatePaths on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$translationExtensionEnabled on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$webpackManifestExtensionConfig on Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Twig\\\\Environment\\:\\:addGlobal\\(\\) expects string, mixed given\\.$#',
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
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$namespace of method Twig\\\\Loader\\\\FilesystemLoader\\:\\:addPath\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
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
	'message' => '#^Method Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:getDefinitions\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:getFallbackParameters\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:getRequiredParameters\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$className of class Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:\\$aliases \\(array\\<non\\-empty\\-string, non\\-empty\\-string\\>\\) does not accept non\\-empty\\-array\\<string, string\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:\\$bindings \\(array\\<class\\-string, non\\-empty\\-string\\>\\) does not accept non\\-empty\\-array\\<class\\-string, string\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:\\$fallbackParameters type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:\\$namespaceScans \\(array\\<non\\-empty\\-string, Jadob\\\\Container\\\\Builder\\\\NamespaceScanConfigurator\\>\\) does not accept non\\-empty\\-array\\<int\\|non\\-empty\\-string, Jadob\\\\Container\\\\Builder\\\\NamespaceScanConfigurator\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:\\$requiredParameters type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/ContainerBuilder.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\NamespaceScanConfigurator\\:\\:\\$fqcnsToExclude \\(list\\<class\\-string\\>\\) does not accept array\\<int\\<0, max\\>\\|string, string\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Builder/NamespaceScanConfigurator.php',
];
$ignoreErrors[] = [
	'message' => '#^Construct empty\\(\\) is not allowed\\. Use more strict comparison\\.$#',
	'identifier' => 'empty.notAllowed',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Compiler\\\\ContainerCompiler\\:\\:processConfigForProvider\\(\\) should return Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Only booleans are allowed in an if condition, bool\\|null given\\.$#',
	'identifier' => 'if.condNotBoolean',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @param references unknown parameter\\: \\$parameters$#',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @return with type void is incompatible with native type Jadob\\\\Container\\\\ServiceGraph\\.$#',
	'identifier' => 'return.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^PHPDoc tag @var with type array\\<Closure\\> is not subtype of type array\\<Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\>\\.$#',
	'identifier' => 'varTag.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$array of function array_diff expects an array of values castable to string, list given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$def of method Jadob\\\\Container\\\\ServiceGraph\\:\\:add\\(\\) expects Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$directories of class Roave\\\\BetterReflection\\\\SourceLocator\\\\Type\\\\DirectoriesSourceLocator constructor expects list\\<string\\>, array\\<string\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$array of function implode expects array\\<string\\>, array\\<int, mixed\\> given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$value of method Jadob\\\\Container\\\\ServiceGraph\\:\\:addParameter\\(\\) expects int\\|string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getName\\(\\) on ReflectionType\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method isBuiltin\\(\\) on ReflectionType\\|null\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\ServiceGraph\\:\\:has\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$objectOrClass of class ReflectionClass constructor expects class\\-string\\<T of object\\>\\|T of object, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serviceId of static method Jadob\\\\Contracts\\\\DependencyInjection\\\\Reference\\:\\:service\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\=\\=\\= between true and true will always evaluate to true\\.$#',
	'identifier' => 'identical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Config\\\\FilesystemConfigNodeFinder\\:\\:find\\(\\) should return array\\<Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\> but returns list\\<object\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Config/FilesystemConfigNodeFinder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Config\\\\InMemoryConfigNodeFinder\\:\\:find\\(\\) should return array\\<Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\> but returns array\\<Closure\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Config/InMemoryConfigNodeFinder.php',
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
	'message' => '#^Method Jadob\\\\Container\\\\ServiceGraph\\:\\:findTagged\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraph.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$tag of method Jadob\\\\Container\\\\ServiceGraph\\:\\:tag\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraph.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return array\\|int\\|object\\|string\\|null but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\ServiceGraphContainer\\:\\:resolveArgs\\(\\) return type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$args of method Jadob\\\\Container\\\\ServiceGraphContainer\\:\\:resolveArgs\\(\\) expects array\\<string, Jadob\\\\Contracts\\\\DependencyInjection\\\\Reference\\|string\\>, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function array_map expects \\(callable\\(mixed\\)\\: mixed\\)\\|null, Closure\\(string\\)\\: object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$callback of function call_user_func_array expects callable\\(\\)\\: mixed, array\\{mixed, string\\} given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\ServiceGraphContainer\\:\\:get\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Jadob\\\\Container\\\\ServiceGraph\\:\\:getParameter\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Jadob\\\\Container\\\\ServiceGraph\\:\\:hasParameter\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$objectOrClass of class ReflectionClass constructor expects class\\-string\\<T of object\\>\\|T of object, string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$tag of method Jadob\\\\Container\\\\ServiceGraph\\:\\:findTagged\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$service of method Jadob\\\\Container\\\\ServiceGraphContainer\\:\\:onServiceInitialized\\(\\) expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\.\\.\\.\\$values of function sprintf expects bool\\|float\\|int\\|string\\|null, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Strict comparison using \\=\\=\\= between Jadob\\\\Contracts\\\\DependencyInjection\\\\ReferenceType\\:\\:Param and Jadob\\\\Contracts\\\\DependencyInjection\\\\ReferenceType\\:\\:Param will always evaluate to true\\.$#',
	'identifier' => 'identical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
];
$ignoreErrors[] = [
	'message' => '#^Unreachable statement \\- code above always terminates\\.$#',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/ServiceGraphContainer.php',
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
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerBuilderInterface\\:\\:addFallbackParameter\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ContainerBuilderInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ContainerBuilderInterface\\:\\:requireParameter\\(\\) has no return type specified\\.$#',
	'identifier' => 'missingType.return',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ContainerBuilderInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:addMethodCall\\(\\) has parameter \\$arguments with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceDefinition.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:replaceArgument\\(\\) has parameter \\$argument with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceDefinition.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:withArgument\\(\\) has parameter \\$argument with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceDefinition.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:\\$arguments \\(array\\<non\\-empty\\-string, Jadob\\\\Contracts\\\\DependencyInjection\\\\Reference\\>\\) does not accept non\\-empty\\-array\\<string, Jadob\\\\Contracts\\\\DependencyInjection\\\\Reference\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceDefinition.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:\\$methodCalls \\(array\\<string, array\\<string, mixed\\>\\>\\) does not accept array\\<string, array\\<int\\|string, mixed\\>\\>\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceDefinition.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:\\$tags type has no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Contracts/DependencyInjection/ServiceDefinition.php',
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
	'message' => '#^Call to method get\\(\\) on an unknown class Jadob\\\\Container\\\\Container\\.$#',
	'identifier' => 'class.notFound',
	'count' => 7,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method generateRoute\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method log\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method render\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
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
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:getFormFactory\\(\\) should return Symfony\\\\Component\\\\Form\\\\FormFactory but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Core\\\\AbstractController\\:\\:getRequest\\(\\) should return Symfony\\\\Component\\\\HttpFoundation\\\\Request but returns mixed\\.$#',
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
	'message' => '#^Property Jadob\\\\Core\\\\AbstractController\\:\\:\\$container \\(Jadob\\\\Container\\\\Container\\) does not accept Psr\\\\Container\\\\ContainerInterface\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/AbstractController.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Core\\\\AbstractController\\:\\:\\$container has unknown class Jadob\\\\Container\\\\Container as its type\\.$#',
	'identifier' => 'class.notFound',
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
	'message' => '#^Class Jadob\\\\Core\\\\UserInterface not found\\.$#',
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
	'message' => '#^Parameter \\#1 \\$callback of function call_user_func_array expects callable\\(\\)\\: mixed, array\\{class\\-string\\|object, \'__invoke\'\\} given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$controllerClass of method Jadob\\\\Core\\\\Dispatcher\\:\\:resolveControllerMethodArguments\\(\\) expects object, class\\-string\\|object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$id of method Psr\\\\Container\\\\ContainerInterface\\:\\:get\\(\\) expects string, array\\|object\\|string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$object of function get_class expects object, class\\-string\\|object given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Core/Dispatcher.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$object_or_class of function method_exists expects object\\|string, mixed given\\.$#',
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
	'count' => 1,
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
	'message' => '#^Property Jadob\\\\Core\\\\Kernel\\:\\:\\$loggerFactory is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
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
	'message' => '#^PHPDoc tag @param references unknown parameter\\: \\$provider$#',
	'identifier' => 'parameter.notFound',
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
	'message' => '#^Property Jadob\\\\Framework\\\\Application\\:\\:\\$fallbackExceptionListener is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$haystack of function in_array expects array, array\\<string, class\\-string\\>\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/RegisterEventListenersExtension.php',
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
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\HandlerConfiguration\\:\\:__construct\\(\\) has parameter \\$channels with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerConfiguration.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\HandlerFactory\\\\LogHandlerFactoryInterface\\:\\:create\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/LogHandlerFactoryInterface.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\HandlerFactory\\\\RotatingFileHandlerFactory\\:\\:create\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/RotatingFileHandlerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$filename of class Monolog\\\\Handler\\\\RotatingFileHandler constructor expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/RotatingFileHandlerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$level of class Monolog\\\\Handler\\\\RotatingFileHandler constructor expects 100\\|200\\|250\\|300\\|400\\|500\\|550\\|600\\|\'ALERT\'\\|\'alert\'\\|\'CRITICAL\'\\|\'critical\'\\|\'DEBUG\'\\|\'debug\'\\|\'EMERGENCY\'\\|\'emergency\'\\|\'ERROR\'\\|\'error\'\\|\'INFO\'\\|\'info\'\\|\'NOTICE\'\\|\'notice\'\\|\'WARNING\'\\|\'warning\', string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/RotatingFileHandlerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Logger\\\\HandlerFactory\\\\StreamHandlerFactory\\:\\:create\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/StreamHandlerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$level of class Monolog\\\\Handler\\\\StreamHandler constructor expects 100\\|200\\|250\\|300\\|400\\|500\\|550\\|600\\|\'ALERT\'\\|\'alert\'\\|\'CRITICAL\'\\|\'critical\'\\|\'DEBUG\'\\|\'debug\'\\|\'EMERGENCY\'\\|\'emergency\'\\|\'ERROR\'\\|\'error\'\\|\'INFO\'\\|\'info\'\\|\'NOTICE\'\\|\'notice\'\\|\'WARNING\'\\|\'warning\', string given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/StreamHandlerFactory.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$stream of class Monolog\\\\Handler\\\\StreamHandler constructor expects resource\\|string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Logger/HandlerFactory/StreamHandlerFactory.php',
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
	'message' => '#^Property Jadob\\\\Framework\\\\Logger\\\\LoggerFactory\\:\\:\\$channelsConfig is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
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
	'message' => '#^Parameter \\#1 \\$commands of method Symfony\\\\Component\\\\Console\\\\Application\\:\\:addCommands\\(\\) expects array\\<\\(callable\\(\\)\\: mixed\\)\\|Symfony\\\\Component\\\\Console\\\\Command\\\\Command\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/ConsoleProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\CsrfProvider\\:\\:getConfigNode\\(\\) never returns string so it can be removed from the return type\\.$#',
	'identifier' => 'return.unusedType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/CsrfProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerConfig\\:\\:configureStreamHandler\\(\\) has parameter \\$channels with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$channels of class Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerHandlerConfig constructor expects array\\<string\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerHandlerConfig\\:\\:withParameters\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerHandlerConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerHandlerConfig\\:\\:\\$parameters \\(array\\<string, int\\|string\\>\\) does not accept array\\.$#',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerHandlerConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Anonymous function should return string but returns string\\|null\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$channels on Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$defaultErrorLoggerChannel on Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$defaultLoggerChannel on Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$handlers on Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerServiceProvider\\:\\:registerLoggerHandlerFactories\\(\\) has parameter \\$handlerTypes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$handlerFactories of class Jadob\\\\Framework\\\\Logger\\\\LoggerFactory constructor expects array\\<string, Jadob\\\\Framework\\\\Logger\\\\HandlerFactory\\\\LogHandlerFactoryInterface\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$level of class Jadob\\\\Framework\\\\Logger\\\\HandlerConfiguration constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$type of class Jadob\\\\Framework\\\\Logger\\\\HandlerConfiguration constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/LoggerServiceProvider.php',
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
	'message' => '#^Parameter \\#1 \\$collection of method Jadob\\\\Router\\\\RouteCollection\\:\\:merge\\(\\) expects Jadob\\\\Router\\\\RouteCollection, mixed given\\.$#',
	'identifier' => 'argument.type',
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
	'message' => '#^Dynamic call to static method PHPUnit\\\\Framework\\\\TestCase\\:\\:createStub\\(\\)\\.$#',
	'identifier' => 'staticMethod.dynamicCall',
	'count' => 3,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Bridge/Doctrine/Persistence/DoctrineConnectionRegistryTest.php',
];
$ignoreErrors[] = [
	'message' => '#^Dynamic call to static method PHPUnit\\\\Framework\\\\TestCase\\:\\:createStub\\(\\)\\.$#',
	'identifier' => 'staticMethod.dynamicCall',
	'count' => 2,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Bridge/Doctrine/Persistence/DoctrineManagerRegistryTest.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\ClassWithBuiltinNonNullableArgument\\:\\:\\$name is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/ClassWithBuiltinNonNullableArgument.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\ClassWithBuiltinNullableArgument\\:\\:\\$name is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/ClassWithBuiltinNullableArgument.php',
];
$ignoreErrors[] = [
	'message' => '#^Attribute class Jadob\\\\Contracts\\\\DependencyInjection\\\\Attribute\\\\InjectService is not repeatable but is already present above the parameter or property\\.$#',
	'identifier' => 'attribute.nonRepeatable',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/InvalidServiceHints/TwoInjectServiceHintsInOneProperty.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Fixtures\\\\InvalidServiceHints\\\\TwoInjectServiceHintsInOneProperty\\:\\:__construct\\(\\) has parameter \\$val with no type specified\\.$#',
	'identifier' => 'missingType.parameter',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/InvalidServiceHints/TwoInjectServiceHintsInOneProperty.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\InvalidServiceHints\\\\TwoInjectServiceHintsInOneProperty\\:\\:\\$val is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/InvalidServiceHints/TwoInjectServiceHintsInOneProperty.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Application\\\\Service\\\\UserService\\:\\:\\$repository is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Application/Service/UserService.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Application\\\\UseCase\\\\SendBirthdayMessageToUser\\:\\:\\$userNotificationService is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Application/UseCase/SendBirthdayMessageToUser.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Application\\\\UseCase\\\\SendBirthdayMessageToUser\\:\\:\\$userService is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Application/UseCase/SendBirthdayMessageToUser.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Database\\\\DynamoDbClient\\:\\:\\$awsClientId is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Database/DynamoDbClient.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Database\\\\DynamoDbClient\\:\\:\\$awsClientSecret is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Database/DynamoDbClient.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Database\\\\DynamoDbClient\\:\\:\\$dynamoDbHost is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Database/DynamoDbClient.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Database\\\\DynamoDbClient\\:\\:\\$tableName is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Database/DynamoDbClient.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Email\\\\UserMailerService\\:\\:\\$smtpHost is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Email/UserMailerService.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Email\\\\UserMailerService\\:\\:\\$smtpPass is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Email/UserMailerService.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Email\\\\UserMailerService\\:\\:\\$smtpPort is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Email/UserMailerService.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Email\\\\UserMailerService\\:\\:\\$smtpUser is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Email/UserMailerService.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Persistence\\\\DynamoDbUserRepository\\:\\:\\$client is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Persistence/DynamoDbUserRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SampleApp\\\\Infrastructure\\\\Persistence\\\\PostgresUserRepository\\:\\:\\$client is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SampleApp/Infrastructure/Persistence/PostgresUserRepository.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SimpleSampleApp\\\\SendHappyBirthdayEmail\\:\\:\\$mailerService is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SimpleSampleApp/SendHappyBirthdayEmail.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Container\\\\Fixtures\\\\SimpleSampleApp\\\\SendHappyBirthdayEmail\\:\\:\\$userService is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/../../tests/unit/Jadob/Container/Fixtures/SimpleSampleApp/SendHappyBirthdayEmail.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
