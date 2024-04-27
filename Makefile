THIS_FILE := $(lastword $(MAKEFILE_LIST))
include .env.example
app-php := $(PROJECT_NAME)-php

# Docker
build:
	docker-compose -f docker-compose.yml up --build -d $(c)
rebuild:
	docker-compose up -d --force-recreate --no-deps --build $(r)
rebuild-app:
	docker-compose up -d --force-recreate --no-deps --build $(app-php)
up:
	docker-compose -f docker-compose.yml up -d $(c)
down:
	docker-compose -f docker-compose.yml down $(c)
it:
	docker exec -it $(app-php) /bin/sh

# Laravel
migrate:
	docker exec $(app-php) php artisan migrate
migrate-rollback:
	docker exec $(app-php) php artisan migrate:rollback
migrate-fresh:
	docker exec $(app-php) php artisan migrate:fresh --seed
migration:
	docker exec $(app-php) php artisan make:migration $(m)
route-list:
	docker exec $(app-php) php artisan route:list
test:
	docker exec $(app-php) php artisan test
art:
	docker exec $(app-php) php artisan $(c)

# Composer
composer-install:
	docker exec $(app-php) composer install --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts
composer-update:
	docker exec $(app-php) composer update --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts
composer-du:
	docker exec $(app-php) composer du
composer-require:
	docker exec $(app-php) composer require $(p) --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts

# Npm
yarn-install:
	docker-compose run --rm --service-ports node $(c)
yarn-dev:
	docker-compose run --rm --service-ports node run dev $(c)
yarn-build:
	docker-compose run --rm --service-ports node run build $(c)

# One command after install
install:
	cp .env.example .env
	make build
	make yarn-install
	make yarn-build
	make composer-install
	docker exec $(app-php) php artisan key:generate
	docker exec $(app-php) php artisan storage:link
	make migrate-fresh