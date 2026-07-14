#!/bin/bash
set -e

# Agar APP_KEY set nahi hai to generate kar lein (pehli dafa)
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Config cache clear (fresh env variables load karne ke liye)
php artisan config:clear

# Database migrations chalana (production mein safe hai --force ke saath)
php artisan migrate --force

# Agar pehli dafa hai to seed bhi kar dein (error ignore, agar already seeded hai)
php artisan db:seed --class=AcademySeeder --force || true

# Render jo bhi PORT assign kare usi pe server start karna
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
