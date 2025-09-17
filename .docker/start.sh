#!/bin/sh

# Start Nginx in the background
nginx -g 'daemon off;' &

# Start PHP-FPM in the foreground
php-fpm
