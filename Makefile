all: submodules-init irc-api-make composer-install clear-cache bower-install assetic-compile db fixtures test
run: services-run server-run

composer-install:
	composer install

clear-cache:
	php app/console cache:clear
	php app/console cache:clear --env=prod

bower-install:
	bower prune --allow-root
	bower install --allow-root

assetic-compile:
	php app/console assetic:dump

db:
	php app/console doctrine:database:drop --force
	php app/console doctrine:database:create
	php app/console doctrine:schema:update --force

fixtures:
	php app/console doctrine:fixtures:load -n

test:

watch:
	php app/console assetic:dump --watch

submodules-init:
	git submodule init
#	git submodule update

irc-api-make:
#	make --directory="services/irc-api/"

services-run:
#	make --directory="services/irc-api/" run

server-run:
	php app/console server:run

ubuntu-install:
	sudo apt-get install php5 php5-mysql mysql-server mod-auth-mysql
