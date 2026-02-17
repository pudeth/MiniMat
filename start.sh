#!/bin/bash

echo "========================================="
echo "Starting MiniMat POS Application"
echo "========================================="
echo ""

# Display environment info
echo "Environment: ${APP_ENV:-not set}"
echo "Debug Mode: ${APP_DEBUG:-not set}"
echo "Port: ${PORT:-8000}"
echo ""

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || echo "Warning: Could not set permissions"

# Clear caches
echo "Clearing caches..."
php artisan config:clear 2>/dev/null || echo "Warning: Could not clear config cache"
php artisan cache:clear 2>/dev/null || echo "Warning: Could not clear cache"
php artisan view:clear 2>/dev/null || echo "Warning: Could not clear view cache"

# Create storage link
echo "Creating storage link..."
php artisan storage:link 2>/dev/null || echo "Storage link already exists or failed"

# Check database connection
echo ""
echo "Testing database connection..."
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'Database: Connected\n'; } catch (Exception \$e) { echo 'Database: Failed - ' . \$e->getMessage() . '\n'; }" 2>/dev/null || echo "Could not test database"

echo ""
echo "========================================="
echo "Starting PHP Server on 0.0.0.0:${PORT:-8000}"
echo "========================================="
echo ""

# Start PHP built-in server
exec php -S 0.0.0.0:${PORT:-8000} -t public
