install: composer cache-clear migrations

dev: composer-dev cache-clear migrations

composer:
	composer install --no-dev

composer-dev:
	composer install

cache-clear:
	bin/cake cache clear_all

migrations:
	bin/cake migrations migrate
