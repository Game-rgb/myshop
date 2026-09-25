#!/bin/bash
set -e

echo "==> Clearing caches..."
php artisan optimize:clear

echo "==> Running migrations..."
php artisan migrate --force || echo "Migrate failed (continuing)"

echo "==> Caching config..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "==> Starting Apache..."
exec "$@"