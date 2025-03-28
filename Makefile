psalm-install:
	mkdir -p tools/psalm
	composer require --dev --working-dir=tools/psalm vimeo/psalm

php-cs-fixer-install:
	mkdir -p tools/php-cs-fixer
	composer require --dev --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

phpunit-install:
	mkdir -p tools
	wget -O phpunit https://phar.phpunit.de/phpunit-11.phar -O tools/phpunit.phar
	chmod +x tools/phpunit.phar

psalm:
	tools/psalm/vendor/bin/psalm

cs-fix:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src --allow-risky=yes

phpunit:
	./tools/phpunit.phar

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