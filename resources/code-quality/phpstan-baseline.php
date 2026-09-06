<?php declare(strict_types = 1);

$ignoreErrors = [];
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
	'message' => '#^Cannot access offset \'managers\' on array\\|Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\.$#',
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
	'message' => '#^Parameter \\#1 \\$conn of class Doctrine\\\\ORM\\\\EntityManager constructor expects Doctrine\\\\DBAL\\\\Connection, object given\\.$#',
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
	'message' => '#^Parameter \\#2 \\$config \\(Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteConfig\\|null\\) of method Jadob\\\\Bridge\\\\Dynamite\\\\ServiceProvider\\\\DynamiteProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
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
	'message' => '#^Parameter \\#2 \\$config \\(Jadob\\\\Bridge\\\\Symfony\\\\Form\\\\ServiceProvider\\\\FormsConfig\\|null\\) of method Jadob\\\\Bridge\\\\Symfony\\\\Form\\\\ServiceProvider\\\\SymfonyFormProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Symfony/Form/ServiceProvider/SymfonyFormProvider.php',
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
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\ServiceProvider\\\\TwigConfig\\:\\:__construct\\(\\) has parameter \\$globals with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigConfig.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Bridge\\\\Twig\\\\ServiceProvider\\\\TwigConfig\\:\\:__construct\\(\\) has parameter \\$templatePaths with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Bridge/Twig/ServiceProvider/TwigConfig.php',
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
	'message' => '#^Method Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:getServiceProviders\\(\\) return type has no value type specified in iterable type array\\.$#',
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
	'message' => '#^Property Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:\\$serviceProviders type has no value type specified in iterable type array\\.$#',
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
	'message' => '#^Parameter \\#2 \\$providers of method Jadob\\\\Container\\\\Compiler\\\\ContainerCompiler\\:\\:resolveServiceProviders\\(\\) expects array\\<Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\>, array given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/ContainerCompiler.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$value of method Jadob\\\\Container\\\\ServiceGraph\\:\\:addParameter\\(\\) expects string, mixed given\\.$#',
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
	'message' => '#^Parameter \\#1 \\$id of method Jadob\\\\Container\\\\ServiceGraph\\:\\:has\\(\\) expects string, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Compiler/Extension/AutowireServices.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$name of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceDefinition\\:\\:withArgument\\(\\) expects string, mixed given\\.$#',
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
	'message' => '#^Method Jadob\\\\Container\\\\Config\\\\ConfigNodeFinder\\:\\:find\\(\\) should return array\\<Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\> but returns list\\<object\\>\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Config/ConfigNodeFinder.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Container\\\\Config\\\\ParameterStore\\:\\:__construct\\(\\) has parameter \\$parameters with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Container/Config/ParameterStore.php',
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
	'message' => '#^Anonymous function should return array\\|object\\|string but returns mixed\\.$#',
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
	'message' => '#^Argument of an invalid type mixed supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getContainerCompilerExtensions\\(\\) on mixed\\.$#',
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
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getConsole\\(\\) should return Symfony\\\\Component\\\\Console\\\\Application but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getLoggerFactory\\(\\) is unused\\.$#',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getLoggerFactory\\(\\) should return Jadob\\\\Framework\\\\Logger\\\\LoggerFactory but returns mixed\\.$#',
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
	'message' => '#^Method Jadob\\\\Framework\\\\Application\\:\\:getRouter\\(\\) should return Jadob\\\\Router\\\\Router but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$object of function get_class expects object, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$paths of class Jadob\\\\Container\\\\Config\\\\ConfigNodeFinder constructor expects array\\<non\\-empty\\-string\\>, array\\{string, non\\-falsy\\-string, non\\-falsy\\-string\\} given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$serviceProvider of method Jadob\\\\Container\\\\Builder\\\\ContainerBuilder\\:\\:registerServiceProvider\\(\\) expects Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#3 \\$eventDispatcher of class Jadob\\\\Core\\\\Dispatcher constructor expects Psr\\\\EventDispatcher\\\\EventDispatcherInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$extension of method Jadob\\\\Container\\\\Compiler\\\\ContainerCompiler\\:\\:addExtension\\(\\) expects Jadob\\\\Contracts\\\\DependencyInjection\\\\CompilerExtensionInterface, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$id of method Jadob\\\\Container\\\\Compiler\\\\ContainerCompiler\\:\\:addExtension\\(\\) expects string, class\\-string\\|false given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\$priority of method Jadob\\\\Container\\\\Compiler\\\\ContainerCompiler\\:\\:addExtension\\(\\) expects int, mixed given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/Application.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Jadob\\\\Framework\\\\Application\\:\\:\\$fallbackExceptionListener is never read, only written\\.$#',
	'identifier' => 'property.onlyWritten',
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
	'message' => '#^Access to an undefined property Jadob\\\\Framework\\\\DependencyInjection\\\\CompilerExtension\\\\InjectLoggerExtension\\:\\:\\$loggerFactory\\.$#',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getDefaultLogger\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot call method getLoggerForChannel\\(\\) on mixed\\.$#',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\DependencyInjection\\\\CompilerExtension\\\\InjectLoggerExtension\\:\\:injectConstructorArgument\\(\\) has parameter \\$argumentAttributes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\DependencyInjection\\\\CompilerExtension\\\\InjectLoggerExtension\\:\\:injectConstructorArgument\\(\\) should return object but returns mixed\\.$#',
	'identifier' => 'return.type',
	'count' => 2,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Jadob\\\\Framework\\\\DependencyInjection\\\\CompilerExtension\\\\InjectLoggerExtension\\:\\:supportsConstructorInjectionFor\\(\\) has parameter \\$argumentAttributes with no value type specified in iterable type array\\.$#',
	'identifier' => 'missingType.iterableValue',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Unreachable statement \\- code above always terminates\\.$#',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/InjectLoggerExtension.php',
];
$ignoreErrors[] = [
	'message' => '#^Unreachable statement \\- code above always terminates\\.$#',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/DependencyInjection/CompilerExtension/RegisterConsoleCommandsExtension.php',
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
	'message' => '#^Method Jadob\\\\Framework\\\\ServiceProvider\\\\CsrfProvider\\:\\:getConfigNode\\(\\) never returns string so it can be removed from the return type\\.$#',
	'identifier' => 'return.unusedType',
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
	'message' => '#^Parameter \\#2 \\$config \\(Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerConfig\\|null\\) of method Jadob\\\\Framework\\\\ServiceProvider\\\\LoggerServiceProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
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
	'message' => '#^Argument of an invalid type list\\<string\\>\\|false supplied for foreach, only iterables are supported\\.$#',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$locale on Jadob\\\\Framework\\\\ServiceProvider\\\\TranslatorConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Cannot access property \\$loggingEnabled on Jadob\\\\Framework\\\\ServiceProvider\\\\TranslatorConfig\\|null\\.$#',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#1 \\$locale of class Symfony\\\\Component\\\\Translation\\\\Translator constructor expects string, string\\|null given\\.$#',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/../../src/Jadob/Framework/ServiceProvider/SymfonyTranslatorProvider.php',
];
$ignoreErrors[] = [
	'message' => '#^Parameter \\#2 \\$config \\(Jadob\\\\Framework\\\\ServiceProvider\\\\TranslatorConfig\\|null\\) of method Jadob\\\\Framework\\\\ServiceProvider\\\\SymfonyTranslatorProvider\\:\\:register\\(\\) should be contravariant with parameter \\$config \\(Jadob\\\\Container\\\\Config\\\\ConfigNodeInterface\\|null\\) of method Jadob\\\\Contracts\\\\DependencyInjection\\\\ServiceProviderInterface\\:\\:register\\(\\)$#',
	'identifier' => 'method.childParameterType',
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

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
