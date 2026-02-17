#!/bin/bash
set -e

echo "========================================="
echo "Starting MiniMat POS Application"
echo "========================================="
echo ""

# Display environment info
echo "PHP Version: $(php -v | head -n 1)"
echo "Environment: ${APP_ENV:-not set}"
echo "Debug Mode: ${APP_DEBUG:-not set}"
echo "Port: ${PORT:-8000}"
echo "APP_KEY: ${APP_KEY:0:20}..."
echo ""

# Check if APP_KEY is set
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set!"
    echo "Please set APP_KEY in Railway environment variables"
    exit 1
fi

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Clear caches to avoid stale config
echo "Clearing caches..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true

# Create storage link
echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

# Optimize for production
if [ "$APP_ENV" = "production" ]; then
    echo "Optimizing for production..."
    php artisan config:cache 2>/dev/null || true
    php artisan route:cache 2>/dev/null || true
    php artisan view:cache 2>/dev/null || true
fi

# Check database connection
echo ""
echo "Testing database connection..."
if php artisan tinker --execute="DB::connection()->getPdo(); echo 'OK';" 2>/dev/null | grep -q "OK"; then
    echo "✓ Database: Connected"
else
    echo "✗ Database: Connection failed"
    echo "Warning: Continuing anyway, but app may not work properly"
fi

echo ""
echo "========================================="
echo "Starting PHP Server on 0.0.0.0:${PORT:-8000}"
echo "========================================="
echo ""

# Create a router script for better handling
cat > router.php << 'EOF'
<?php
// Router script for PHP built-in server
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files directly
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Otherwise, serve through Laravel
require_once __DIR__ . '/public/index.php';
EOF

# Start PHP built-in server with router
exec php -S 0.0.0.0:${PORT:-8000} -t public router.php
