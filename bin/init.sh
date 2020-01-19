#!/bin/bash

# The base path of the shell script
BASE_PATH=$(cd "$(dirname "$0")" ; pwd -P)

# The project root path
PROJECT_PATH="$(dirname "$BASE_PATH")"

cd $PROJECT_PATH

composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
npm install && npm run dev
