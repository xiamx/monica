#! /bin/bash
set -e

git pull
composer install --no-interaction --no-suggest --no-dev
yarn install
yarn prod
php artisan monica:update --force