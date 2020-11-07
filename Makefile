.SILENT:

include .env
## Colors
COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m

## Help
help:
	printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	printf " make [target]\n\n"
	printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf " ${COLOR_INFO}%-16s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

###########
# Install #
###########

## Install application
.PHONY: install
install:
	# Composer
	composer install --verbose
	# Db
	bin/console doctrine:database:create --if-not-exists
	bin/console doctrine:schema:update --force
	# Db - Test
	bin/console doctrine:database:create --if-not-exists --env=test
	bin/console doctrine:schema:update --force --env=test
	# Db - Fixtures
	#bin/console doctrine:fixtures:load --no-interaction
	# Db - Fixtures - Test
	#bin/console doctrine:fixtures:load --no-interaction --env=test

.PHONY: install@test
install@test: export APP_ENV = test
install@test: comp-inst
	# Composer

	# Db
	bin/console doctrine:database:drop --force --if-exists
	bin/console doctrine:database:create --if-not-exists
	bin/console doctrine:schema:update --force
	# Db - Fixtures
	#bin/console doctrine:fixtures:load --no-interaction

## Composer install
comp-inst:
	composer install --verbose --no-progress --no-interaction
## Composer update
comp-upd:
	composer update --verbose

###################
# Coding standard #
###################

## Coding standard
.PHONY: lint
lint: cs-fixer pstan

## Php-cs-fixer
cs-fixer:
	./bin/php-cs-fixer fix
	./bin/phpcbf
## PhpStan
pstan:
	./bin/phpstan analyse

.PHONY: lint@test
lint@test: export APP_ENV = test
lint@test: lint

############
# Database #
############

## Make migration
db-diff:
	bin/console doctrine:migrations:diff

## Migrate migrations
db-migrate:
	bin/console doctrine:migrations:migrate

#########
# Tests #
#########

## Tests
.PHONY: tests
tests: unit #behat

## Unit tests
.PHONY: unit
unit:
	@bin/phpunit

## Behat tests
.PHONY: behat
behat:
	bin/console cache:clear && vendor/bin/behat

#################
# Symfony tools #
#################

## Clear cache
cc:
	bin/console c:c

cc@test: export APP_ENV = test
cc@test: cc
