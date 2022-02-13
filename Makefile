install-tools:
	mkdir -p tools/php-cs-fixer
	composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

cs-fix:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src --allow-risky=yes

purge-vendors:
	# remove lockfiles
	rm src/Jadob/Core/composer.lock
	rm src/Jadob/Bridge/Monolog/composer.lock
	#remove vendors
	rm -rf src/Jadob/Core/vendor
	rm -rf src/Jadob/Bridge/Monolog/vendor
