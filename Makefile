.SILENT:
.PHONY: build

# Alias
CONSOLE=php bin/console
COMPOSER=php composer.phar
PHP_HOST=docker-compose exec --user 33 php

# Variables
ENV=$(shell $(PHP_HOST) printenv APP_ENV)
PERMISSIONS=$(if ($(ENV), dev), 777, 775)

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

###############
# Environment #
###############
## Start docker containers
start:
	docker-compose build
	docker-compose up -d

## Stop docker containers
stop:
	docker-compose stop

## Clean symfony environment
clean:
	$(PHP_HOST) $(CONSOLE) cache:clear


############
# Database #
############
## Update the database
db:
	$(PHP_HOST) $(CONSOLE) doctrine:schema:update --force --no-interaction

## Drop and re-create the database
db@refresh:
	$(PHP_HOST) $(CONSOLE) doctrine:schema:drop --force --no-interaction
	$(PHP_HOST) $(CONSOLE) doctrine:schema:create --no-interaction

## Launch doctrine fixtures
db@fixtures:
	$(PHP_HOST) $(CONSOLE) doctrine:fixtures:load --no-interaction

###########
# Install #
###########
## Install project dependencies
install:
	# Npm depencies
	yarn install
	# Composer
	$(COMPOSER) install --verbose --optimize-autoloader

## Install project dependencies for prod (only)
install@prod: export SYMFONY_ENV = prod
install@prod:
	# Npm depencies
	yarn install
	# Composer
	$(COMPOSER) install --verbose --no-progress --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-suggest
	# Symfony cache
	$(CONSOLE) cache:warmup --no-debug

#########
# Build #
#########
## Build the project
build:
	yarn run encore dev

## Build the project for prod (only)
build@prod:
	yarn run encore production
	make security

############
# Security #
############
## Security check command from Symfony
security:
	$(CONSOLE) security:check

#####################
# Lint / Code rules #
#####################
## Run grumphp
grum:
	php vendor/phpro/grumphp/bin/grumphp run

## Launch php-cs-fixer on src/
fix:
	php vendor/bin/php-cs-fixer --allow-risky=no --using-cache=yes --path-mode=intersection --verbose fix src/
