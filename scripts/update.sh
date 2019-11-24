#! /bin/bash
set -e
export NODE_ENV=production
git pull
composer install --no-interaction --no-suggest --no-dev
yarn install
yarn prod
php artisan monica:update --force