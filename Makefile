ifneq (,$(wildcard ./.env))
  	include .env
  	export
endif

.PHONY: up
up: .env
	docker compose up --build -d

.PHONY: stop
stop: .env
	docker compose stop

.env:
	cp .env.example .env

vendor: composer.lock composer.json
	docker compose exec --user ${WWW_USER} app composer install

node_modules: package.json package-lock.json
	docker compose exec --user ${WWW_USER} app npm ci

.PHONY: run-prod
run-prod: node_modules
	docker compose exec --user ${WWW_USER} app npm run build

.PHONY: run-dev
run-dev: node_modules
	docker compose exec --user ${WWW_USER} app npm run dev

.PHONY: migrate
migrate: vendor
	docker compose exec --user ${WWW_USER} app php artisan migrate:refresh --seed

.PHONY: install
install: vendor run-prod migrate
	docker compose exec --user ${WWW_USER} app php artisan key:generate

.PHONY: test
test: vendor
	docker compose exec --user ${WWW_USER} app php artisan test

.PHONY: db
db: vendor
	docker compose exec --user ${WWW_USER} app php artisan db

.PHONY: cli
cli:
	docker compose exec --user ${WWW_USER} app bash
