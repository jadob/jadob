install-tools:
	mkdir -p tools/php-cs-fixer
	composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

cs-fix:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src