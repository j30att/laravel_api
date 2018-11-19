web: composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader && ./artisan config:cache && ./artisan route:cache && ./artisan view:cache && ./artisan migrate --force && $(composer config bin-dir)/heroku-php-apache2 public/
worker: php artisan queue:work redis --sleep=3 --tries=3 --daemon
