<?php

/**
 * Test Railway MySQL Database Connection
 * Run: php test-railway-db.php
 */

echo "========================================\n";
echo "Testing Railway MySQL Connection\n";
echo "========================================\n\n";

$host = 'yamanote.proxy.rlwy.net';
$port = '59771';
$database = 'railway';
$username = 'root';
$password = 'WyPIbklfTJprYBpdWtNMooiGFDchLuLM';

echo "Host: $host\n";
echo "Port: $port\n";
echo "Database: $database\n";
echo "Username: $username\n\n";

try {
    echo "Attempting connection...\n";
    
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✅ Connection successful!\n\n";
    
    // Test query
    echo "Testing database query...\n";
    $stmt = $pdo->query("SELECT VERSION() as version, DATABASE() as db");
    $result = $stmt->fetch();
    
    echo "✅ MySQL Version: " . $result['version'] . "\n";
    echo "✅ Current Database: " . $result['db'] . "\n\n";
    
    // Check tables
    echo "Checking existing tables...\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "✅ Found " . count($tables) . " tables:\n";
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
    } else {
        echo "⚠️  No tables found. You need to run migrations.\n";
    }
    
    echo "\n========================================\n";
    echo "✅ Database is ready!\n";
    echo "========================================\n\n";
    
    echo "Next steps:\n";
    echo "1. Deploy your Laravel app to Railway\n";
    echo "2. Add environment variables from .env.railway.complete\n";
    echo "3. Run: php artisan migrate --force\n";
    echo "4. Run: php create-admin.php\n\n";
    
} catch (PDOException $e) {
    echo "❌ Connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    echo "Troubleshooting:\n";
    echo "1. Check if MySQL service is running in Railway\n";
    echo "2. Verify credentials are correct\n";
    echo "3. Check if your IP is allowed (Railway allows all by default)\n";
    echo "4. Try again in a few seconds\n";
    exit(1);
}
