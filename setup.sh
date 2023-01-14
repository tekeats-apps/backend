#!/bin/bash
#Download all dependencies from remote composer container
docker run --rm -v $(pwd):/opt -w /opt laravelsail/php81-composer:latest composer install

#Copy ENV example to .env file
# cp .env.example .env
#Give permissions to directories
chmod -R 777 ./bootstrap/cache
chmod -R 777 ./storage

#Remove existing containers
./vendor/bin/sail down

#Build containers
./vendor/bin/sail build

#Start containers
./vendor/bin/sail up -d
