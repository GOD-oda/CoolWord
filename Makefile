up:
	docker compose up -d --remove-orphans

down:
	docker compose down -v --remove-orphans

restart:
	@make down
	@make up

migrate:
	docker compose exec app composer setup-data

setup:
	mkdir -p src
	@make build
	@make up
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link

build:
	docker compose build --force-rm --no-cache

rebuild:
	docker compose down -v --remove-orphans --rmi all
	@make build

phpunit:
	@make down
	docker compose run --rm app composer phpunit

phpstan:
	docker compose run --rm app composer phpstan