.SILENT:
#==========VARIABLES================================================

host = http://192.168.126.101
elastic_host = http://192.168.126.106:9200
kibana_host = http://192.168.126.107:5601
php_container = larka_php
nodejs_container = larka_nodejs
redis_container = larka_redis

#==========MAIN_COMMAND=============================================

up: docker_up info
restart: docker_down up
init: docker_down cp_env build docker_up cp_env app_init permission memory api_docs info
test: test_run

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
	docker-compose exec $(php_container) php artisan db:seed --class=UserRoleTableSeeder
	docker-compose exec $(php_container) php artisan admin:create

bench:
	docker-compose exec $(php_container) php bench.php -m=64 -t=30

info:
	echo "$(host)"
	echo "API - $(host)/api/documentation"
	echo "PHP_INFO - $(host)/phpinfo.php"
	echo "ELASTICSEARCH - $(elastic_host)"
	echo "KIBANA - $(kibana_host)"

test-run:
	docker-compose exec $(php_container) php ./vendor/bin/phpunit

# for elasticsearch
#memory:
	#sudo sysctl -w vm.max_map_count=262144

api_docs:
	docker-compose exec $(php_container) php artisan l5-swagger:generate
	sudo chmod 777 -R storage/api-docs
#===================FRONT==============================================

npm_init:
	docker-compose exec $(nodejs_container) npm install
	sudo chmod 777 -R node_modules

watch:
	docker-compose exec $(nodejs_container) npm run watch

#===================INTO_CONTAINER======================================

php_bash:
	docker exec -it $(php_container) bash

node_bash:
	docker exec -it $(nodejs_container) bash

redis_bash:
	docker exec -it $(redis_container) sh

#===================TEST================================================

test_init:
	cp .env.testing.example .env.testing
	docker-compose exec $(php_container) php artisan key:generate --env=testing -n
	docker-compose exec $(php_container) php artisan migrate -n --env=testing
	docker-compose exec $(php_container) php artisan admin:create --env=testing
	docker-compose exec $(php_container) php artisan passport:test --env=testing