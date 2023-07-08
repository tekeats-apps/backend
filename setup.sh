#!/bin/bash
# Copy ENV example to .env file
cp .env.example .env
# Give permissions to directories
chmod -R 777 ./bootstrap/cache
chmod -R 777 ./storage

# Remove existing containers
docker-compose down

# Build and start containers
docker-compose up -d --build

# Run Composer install inside the PHP container
docker-compose exec -T app composer install

# Run artisan commands inside the PHP container
docker-compose exec -T app php artisan key:generate
docker-compose exec -T app php artisan migrate --seed
