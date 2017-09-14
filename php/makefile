.phony: up down restart clean tests

clean: down

install:

up:
	docker-compose up

tests:
	docker-compose run --user bigtincan php vendor/bin/phpunit --configuration test/phpunit.xml

down:
	docker-compose stop

bash:
	docker-compose run php bash

restart: down up

world: clean install up

build:
	docker-compose build php



composer:
	docker-compose run --user bigtincan php composer require --dev phpunit/phpunit
	docker-compose run --user bigtincan php composer require guzzlehttp/guzzle
	docker-compose run --user bigtincan php composer require --dev php-di/php-di
	docker-compose run --user bigtincan php composer require --dev vlucas/phpdotenv


di:
	docker-compose run --user bigtincan php composer require --dev shrikeh/teapot
