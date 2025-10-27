PHPSTAN_BASE := vendor/bin/phpstan

psalm:
	vendor/bin/psalm

cs-fix:
	PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix src --allow-risky=yes

phpunit:
	vendor/bin/phpunit

phpstan:
	$(PHPSTAN_BASE) analyse --configuration phpstan.dist.neon

phpstan-baseline:
	$(PHPSTAN_BASE) --generate-baseline=./resources/code-quality/phpstan-baseline.neon

purge-vendors:
	rm -rf src/Jadob/Core/vendor
	rm -rf src/Jadob/Core/composer.lock
	rm -rf src/Jadob/Bridge/Monolog/vendor
	rm -rf src/Jadob/Bridge/Monolog/composer.lock
	rm -rf src/Jadob/Bridge/Aws/vendor
	rm -rf src/Jadob/Bridge/Aws/composer.lock
	rm -rf src/Jadob/Bridge/Aws/Ses/vendor
	rm -rf src/Jadob/Bridge/Aws/Ses/composer.lock
	rm -rf src/Jadob/Bridge/Twig/vendor
	rm -rf src/Jadob/Bridge/Twig/composer.lock
	rm -rf src/Jadob/EventDispatcher/vendor
	rm -rf src/Jadob/EventDispatcher/composer.lock
	rm -rf src/Jadob/Bridge/Doctrine/Annotations/vendor
	rm -rf src/Jadob/Bridge/Doctrine/Annotations/composer.lock
	rm -rf src/Jadob/Bridge/Doctrine/ORM/vendor
	rm -rf src/Jadob/Bridge/Doctrine/ORM/composer.lock