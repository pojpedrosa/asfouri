#!/usr/bin/env bash
# Run on the droplet. Triggered by GitHub Actions (or manually as `bash deploy/deploy.sh`).
# Deploys whatever directory this script lives in, from origin/main.
set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
BRANCH="main"

echo "==> Deploying asfouri from origin/$BRANCH to $APP_DIR"
cd "$APP_DIR"

# Hard reset to remote (no merge surprises)
git fetch --prune --depth=1 origin "$BRANCH"
git reset --hard "origin/$BRANCH"

# PHP deps (no dev packages on the server)
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# JS deps + build assets
npm ci --prefer-offline --no-audit --no-fund
npm run build

# Laravel housekeeping
php artisan migrate --force
[ -L public/storage ] || php artisan storage:link
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Make sure writable dirs are writable by both deploy user and php-fpm (www-data).
chgrp -R www-data storage bootstrap/cache 2>/dev/null || true
find storage bootstrap/cache -user "$(whoami)" -exec chmod ug+rwX {} + 2>/dev/null || true

# Reload php-fpm so opcache picks up new code.
sudo /bin/systemctl reload php8.5-fpm

echo "==> asfouri deployed at $(date -u +%Y-%m-%dT%H:%M:%SZ)"
