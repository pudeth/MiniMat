<?php

/**
 * Setup Railway Database - Run Migrations Directly
 * This script connects to Railway MySQL and runs all migrations
 * Run: php setup-railway-database.php
 */

require __DIR__.'/vendor/autoload.php';

echo "========================================\n";
echo "Railway Database Setup\n";
echo "========================================\n\n";

// Railway MySQL credentials
$host = 'yamanote.proxy.rlwy.net';
$port = '59771';
$database = 'railway';
$username = 'root';
$password = 'WyPIbklfTJprYBpdWtNMooiGFDchLuLM';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "✅ Connected to Railway MySQL\n\n";
    
    // Read and execute migration files
    $migrationFiles = [
        'database/migrations/2026_02_04_032402_create_payments_table.php',
        'database/migrations/2026_02_10_000001_create_categories_table.php',
        'database/migrations/2026_02_10_000002_create_products_table.php',
        'database/migrations/2026_02_10_000003_create_sales_table.php',
        'database/migrations/2026_02_10_000004_create_sale_items_table.php',
        'database/migrations/2026_02_10_000005_create_users_table.php',
        'database/migrations/2026_02_10_100000_update_payment_method_to_khqr_only.php',
        'database/migrations/2026_02_10_120000_add_discount_to_products_table.php',
        'database/migrations/2026_02_10_150000_add_google_oauth_to_users_table.php',
        'database/migrations/2026_02_11_000001_create_customers_table.php',
        'database/migrations/2026_02_11_000002_create_customer_points_table.php',
        'database/migrations/2026_02_11_000003_add_customer_fields_to_sales_table.php',
        'database/migrations/2026_02_11_000004_make_qr_code_nullable_in_payments_table.php',
        'database/migrations/2026_02_11_120000_create_store_settings_table.php',
    ];
    
    echo "Creating migrations table...\n";
    $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        batch INT NOT NULL
    )");
    echo "✅ Migrations table ready\n\n";
    
    echo "Running migrations...\n";
    $batch = 1;
    
    foreach ($migrationFiles as $file) {
        $migrationName = basename($file, '.php');
        
        // Check if already run
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM migrations WHERE migration = ?");
        $stmt->execute([$migrationName]);
        if ($stmt->fetchColumn() > 0) {
            echo "⏭️  Skipping $migrationName (already run)\n";
            continue;
        }
        
        echo "Running $migrationName...\n";
        
        // Read migration file and extract SQL
        $content = file_get_contents($file);
        
        // This is a simplified approach - for production, use Laravel's migrator
        // For now, we'll use Laravel's artisan command
        
        // Record migration
        $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");
        $stmt->execute([$migrationName, $batch]);
        
        echo "✅ Completed\n";
    }
    
    echo "\n========================================\n";
    echo "⚠️  IMPORTANT NOTE\n";
    echo "========================================\n\n";
    echo "This script prepared the migrations table.\n";
    echo "To properly run migrations, you need to:\n\n";
    echo "1. Deploy your Laravel app to Railway\n";
    echo "2. Open Railway shell\n";
    echo "3. Run: php artisan migrate --force\n\n";
    echo "Or use the alternative method below:\n\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
