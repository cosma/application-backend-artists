up:
	@docker-compose up -d
	@docker-compose exec php composer install
	@docker-compose exec php bin/console doctrine:database:create --if-not-exists
	@docker-compose exec php bin/console doctrine:schema:update --force
	@docker-compose exec php bin/console doctrine:fixtures:load -q

down:
	@docker-compose down

start:
	@docker-compose up -d
	@docker-compose exec php bin/console server:start 0.0.0.0:8888

status:
	@docker-compose up -d
	@docker-compose exec php bin/console server:status

stop:
	@docker-compose up -d
	@docker-compose exec php bin/console server:stop

