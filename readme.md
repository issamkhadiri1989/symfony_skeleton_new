# SETUP the project locally
## Build and start containers 

run the command 

```
docker compose up -d --build
```

this will build and start containers. if you have issues with ports, please choose other ports in the `docker-compose.yaml` file and retry.

once finished, try to run 

```
docker compose ps
```

to make sure that all containers are `up`

to enter the container, please run the command 

```
docker compose exec <the service name> bash
```

for example, to enter the `server` container (which contains the source code), run `docker compose exec server bash`

tape `exit` if you want to quit the container and go back to host.

![alt text](doc/image.png)

to stop the containers, run 

```
docker compose stop
```

to restart the containers without rebuilding them 

```
docker compose up -d 
```

> all symfony commands (like make commands) must be run inside the container


## Install Symfony and dependencies


```
// start the containers if not already started
docker compose up -d
```

```
// enter the server container
docker compose exec server bash
```



now that you are inside the `server` container, run the following commands inside the `server` container

```
composer self-update
composer install
```

this project contains :

- empty Symfony project with the lastest version (7.0.4)
-  StofDoctrineExtensionsBundle: https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html
- Foundry: https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html
- DoctrineFixturesBundle: https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html


## Confiugure the project

inside the `server` container, run the command 

```
composer dump-env dev
```

this will create a `.env.local.php` file. the content of this file should look like the following

```
<?php

return array (
  'APP_ENV' => 'dev',
  'APP_SECRET' => 'f693cb9d977ca50c10babcc0dcc31ec0',
  'DATABASE_URL' => 'postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8',
  'MESSENGER_TRANSPORT_DSN' => 'doctrine://default?auto_setup=0',
);

```

please change the `DATABASE_URL` value with ***mysql://root:superSecr3t@database/XXX?serverVersion=8.0.32&charset=utf8mb4***

the docker setup has already created an empty database called `database`. if you want to change it, change the value of `DATABASE_URL` like 

```
'DATABASE_URL' => 'mysql://root:superSecr3t@database/XXX?serverVersion=8.0.32&charset=utf8mb4',
``` 
where `XXX` is the new database name. then, run the command

```
php bin/console doctrine:database:create
```

to create the new database.

## Load fixtures

to load data in the database, run the commad: 

```
php bin/console doctrine:fixtures:load
```

and answer `yes`.

## Create a new controller

to create a new Controller / pages, you need to run the following command: 

```
php bin/console make:controller
```


## Create entities

to create (or update) entities, run the following command:

```
php bin/console make:entity
```

## Create migration

to create  and apply migrations, run the following commands

```
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

## Create a new Foundry factory 

to create a Foundry factory, run the following command: 

```
php bin/console make:factory
```

