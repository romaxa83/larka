.SILENT:
#==========VARIABLES================================================

php_container = larka_php
nodejs_container = larka_nodejs

#==========MAIN_COMMAND=============================================

up: docker_up info
restart: docker_down up
init: docker_down cp_env build docker_up cp_env app_init permission api_docs info
test: test-run

#==========COMMAND==================================================

build:
	docker-compose build

docker_up:
	docker-compose up -d

docker_down:
	docker-compose down --remove-orphans #очистит все запущеные контейнеры

cp_env:
	cp .env.example .env

permission:
	sudo chmod 777 -R -f vendor/
	sudo chmod 777 -R -f docker/storage
	sudo chmod 777 -R -f storage

app_init:
	docker-compose exec $(php_container) composer install
	docker-compose exec $(php_container) php artisan key:generate
	docker-compose exec $(php_container) php artisan migrate
	docker-compose exec $(php_container) php artisan ide-helper:generate
	docker-compose exec $(php_container) php artisan ide-helper:meta
	docker-compose exec $(php_container) php artisan passport:install
	docker-compose exec $(php_container) php artisan admin:create

info:
	echo "http://192.168.126.101"
	echo "API - http://192.168.126.101/api/documentation"

test-run:
	docker-compose exec $(php_container) php ./vendor/bin/phpunit

api_docs:
	docker-compose exec $(php_container) php artisan l5-swagger:generate
	sudo chmod 777 -R storage/api-docs
#===================NODEJS==============================================

npm_init:
	docker-compose exec $(nodejs_container) npm install
	sudo chmod 777 -R node_modules

#===================INTO_CONTAINER======================================

php_bash:
	docker exec -it $(php_container) bash

node_bash:
	docker exec -it $(nodejs_container) bash

#===================TEST================================================

test_init:
	cp .env.testing.example .env.testing
	docker-compose exec $(php_container) php artisan key:generate --env=testing -n
	docker-compose exec $(php_container) php artisan migrate -n --env=testing
	docker-compose exec $(php_container) php artisan admin:create --env=testing
	docker-compose exec $(php_container) php artisan passport:test --env=testing