#!/bin/sh
# Health check script for PHP-FPM

# Check if PHP-FPM is responding
if php-fpm-healthcheck; then
    exit 0
fi

# Fallback: check if PHP-FPM process is running
if pgrep php-fpm > /dev/null; then
    exit 0
fi

exit 1
