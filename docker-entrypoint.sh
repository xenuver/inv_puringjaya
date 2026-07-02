#!/bin/bash
set -e

echo "Menjalankan composer install (jika vendor kosong)..."
if [ ! -d "vendor" ]; then
    composer install --no-interaction --optimize-autoloader --no-dev
fi

echo "Membuat storage link jika belum ada..."
php artisan storage:link || true

echo "Menjalankan migrasi database..."
php artisan migrate --force

echo "Menjalankan seeder (akan insert jika tabel kosong)..."
php artisan db:seed --force

echo "Mengoptimalkan performa Laravel..."
php artisan optimize

echo "Memulai server Apache..."
exec "$@"
