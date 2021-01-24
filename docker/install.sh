#!/bin/sh

docker-compose build;
docker-compose up -d;
docker-compose exec php composer install;
sleep 10; # quick fix to wait for mysql to be ready
docker-compose exec mysql mysql -u root -e "CREATE DATABASE colored_balls";
docker-compose exec php php artisan migrate;
docker-compose exec php chmod -R 777 /code; # quick fix for permissions
