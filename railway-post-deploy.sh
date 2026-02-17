#!/bin/bash

# Railway Post-Deployment Script
# Run this in Railway shell after first deployment

echo "=========================================="
echo "Railway Post-Deployment Setup"
echo "=========================================="
echo ""

# Run migrations
echo "Step 1: Running database migrations..."
php artisan migrate --force

if [ $? -eq 0 ]; then
    echo "✅ Migrations completed successfully"
else
    echo "❌ Migration failed"
    exit 1
fi

echo ""

# Create storage link
echo "Step 2: Creating storage link..."
php artisan storage:link

echo ""

# Clear and cache config
echo "Step 3: Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""

# Check database connection
echo "Step 4: Testing database connection..."
php artisan tinker --execute="echo 'Database connected: ' . (DB::connection()->getPdo() ? 'YES' : 'NO') . PHP_EOL;"

echo ""

# Show table count
echo "Step 5: Checking database tables..."
php artisan tinker --execute="echo 'Tables created: ' . count(DB::select('SHOW TABLES')) . PHP_EOL;"

echo ""

echo "=========================================="
echo "✅ Post-deployment setup complete!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Create admin user (see RAILWAY-SETUP.md)"
echo "2. Load sample data (optional)"
echo "3. Test the application"
echo ""
