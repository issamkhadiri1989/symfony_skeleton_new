SYMFONY_VERSION=7.0.*
SDIR=source

start:
	docker-compose up -d --no-recreate --remove-orphans

stop:
	docker container stop $$(docker container ps -qa)

build:
	docker-compose build --force-rm

enter:
	docker-compose exec server bash

ps:
	docker-compose ps

install: install-packages install-database

install-packages:
	docker-compose exec server composer install

update-schema: 
	docker-compose exec server php bin/console doctrine:schema:update --force

load-fixtures:
	docker-compose exec server php bin/console doctrine:fixtures:load

install-database: update-schema load-fixtures