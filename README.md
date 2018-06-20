#boilerplate


Une page de contact avec des champs dynamiques


####Prerequis

- docker & docker-compose
- npm & yarn
- php 7.1

### Start env ( with docker )
    cp .env.dist .env
    make start

### Start env ( without docker )

    composer require symfony/web-server-bundle --dev
    php bin/console server:start
    
###Install the project
    make install
    make build
