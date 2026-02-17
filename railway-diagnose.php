#!/usr/bin/env php
<?php

/**
 * Railway Diagnostic and Auto-Fix Script
 * This script diagnoses common Railway deployment issues
 */

echo "\n";
echo "========================================\n";
echo "Railway Deployment Diagnostic Tool\n";
echo "========================================\n\n";

$errors = [];
$warnings = [];
$fixes = [];

// Check 1: PHP Version
echo "✓ Checking PHP version...\n";
$phpVersion = phpversion();
echo "  PHP Version: $phpVersion\n";
if (version_compare($phpVersion, '8.1.0', '<')) {
    $errors[] = "PHP version must be 8.1 or higher";
}

// Check 2: Required Extensions
echo "\n✓ Checking PHP extensions...\n";
$requiredExtensions = ['pdo', 'pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach ($requiredExtensions as $ext) {
    if (extension_loaded($ext)) {
        echo "  ✓ $ext\n";
    } else {
        $errors[] = "Missing PHP extension: $ext";
        echo "  ✗ $ext (MISSING)\n";
    }
}

// Check 3: Environment File
echo "\n✓ Checking environment configuration...\n";
if (!file_exists(__DIR__ . '/.env')) {
    $warnings[] = ".env file not found (Railway uses environment variables)";
    echo "  ⚠ .env file not found (OK for Railway)\n";
} else {
    echo "  ✓ .env file exists\n";
}

// Check 4: Required Environment Variables
echo "\n✓ Checking environment variables...\n";
$requiredEnvVars = [
    'APP_KEY' => 'Application encryption key',
    'APP_ENV' => 'Application environment',
    'DB_CONNECTION' => 'Database connection type',
    'DB_HOST' => 'Database host',
    'DB_PORT' => 'Database port',
    'DB_DATABASE' => 'Database name',
    'DB_USERNAME' => 'Database username',
    'DB_PASSWORD' => 'Database password',
];

foreach ($requiredEnvVars as $var => $description) {
    $value = getenv($var);
    if ($value === false || $value === '') {
        $errors[] = "Missing environment variable: $var ($description)";
        echo "  ✗ $var (MISSING)\n";
    } else {
        if ($var === 'DB_PASSWORD' || $var === 'APP_KEY') {
            echo "  ✓ $var (set)\n";
        } else {
            echo "  ✓ $var = $value\n";
        }
    }
}

// Check 5: Vendor Directory
echo "\n✓ Checking dependencies...\n";
if (!is_dir(__DIR__ . '/vendor')) {
    $errors[] = "Vendor directory not found. Run: composer install";
    echo "  ✗ vendor/ directory missing\n";
} else {
    echo "  ✓ vendor/ directory exists\n";
}

// Check 6: Storage Permissions
echo "\n✓ Checking storage permissions...\n";
$storageDirs = ['storage/framework', 'storage/logs', 'bootstrap/cache'];
foreach ($storageDirs as $dir) {
    $path = __DIR__ . '/' . $dir;
    if (!is_dir($path)) {
        $errors[] = "Directory not found: $dir";
        echo "  ✗ $dir (NOT FOUND)\n";
    } elseif (!is_writable($path)) {
        $warnings[] = "Directory not writable: $dir";
        echo "  ⚠ $dir (NOT WRITABLE)\n";
        $fixes[] = "chmod -R 775 $dir";
    } else {
        echo "  ✓ $dir\n";
    }
}

// Check 7: Database Connection
echo "\n✓ Testing database connection...\n";
if (getenv('DB_HOST') && getenv('DB_USERNAME')) {
    try {
        require __DIR__ . '/vendor/autoload.php';
        $app = require_once __DIR__ . '/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        
        DB::connection()->getPdo();
        echo "  ✓ Database connection successful\n";
        
        // Check if migrations table exists
        $tables = DB::select('SHOW TABLES');
        echo "  ✓ Found " . count($tables) . " tables in database\n";
        
    } catch (Exception $e) {
        $errors[] = "Database connection failed: " . $e->getMessage();
        echo "  ✗ Database connection failed\n";
        echo "    Error: " . $e->getMessage() . "\n";
    }
} else {
    $warnings[] = "Database credentials not set, skipping connection test";
    echo "  ⚠ Skipped (no credentials)\n";
}

// Check 8: Public Directory
echo "\n✓ Checking public directory...\n";
if (!file_exists(__DIR__ . '/public/index.php')) {
    $errors[] = "public/index.php not found";
    echo "  ✗ public/index.php missing\n";
} else {
    echo "  ✓ public/index.php exists\n";
}

// Check 9: Start Script
echo "\n✓ Checking start script...\n";
if (!file_exists(__DIR__ . '/start.sh')) {
    $warnings[] = "start.sh not found";
    echo "  ⚠ start.sh not found\n";
} else {
    echo "  ✓ start.sh exists\n";
    if (!is_executable(__DIR__ . '/start.sh')) {
        $fixes[] = "chmod +x start.sh";
        echo "  ⚠ start.sh not executable\n";
    }
}

// Summary
echo "\n========================================\n";
echo "Diagnostic Summary\n";
echo "========================================\n\n";

if (count($errors) === 0 && count($warnings) === 0) {
    echo "✅ All checks passed! Your application should work.\n\n";
} else {
    if (count($errors) > 0) {
        echo "❌ ERRORS FOUND (" . count($errors) . "):\n";
        foreach ($errors as $i => $error) {
            echo "  " . ($i + 1) . ". $error\n";
        }
        echo "\n";
    }
    
    if (count($warnings) > 0) {
        echo "⚠️  WARNINGS (" . count($warnings) . "):\n";
        foreach ($warnings as $i => $warning) {
            echo "  " . ($i + 1) . ". $warning\n";
        }
        echo "\n";
    }
}

if (count($fixes) > 0) {
    echo "🔧 SUGGESTED FIXES:\n";
    foreach ($fixes as $i => $fix) {
        echo "  " . ($i + 1) . ". $fix\n";
    }
    echo "\n";
}

// Auto-fix option
if (count($fixes) > 0) {
    echo "Would you like to apply these fixes? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) === 'y') {
        echo "\nApplying fixes...\n";
        foreach ($fixes as $fix) {
            echo "Running: $fix\n";
            system($fix);
        }
        echo "✅ Fixes applied!\n\n";
    }
    fclose($handle);
}

echo "========================================\n";
echo "Next Steps for Railway:\n";
echo "========================================\n\n";
echo "1. Make sure all environment variables are set in Railway dashboard\n";
echo "2. Copy variables from .env.railway.complete file\n";
echo "3. Ensure APP_URL matches your Railway domain\n";
echo "4. Redeploy your application\n\n";

if (count($errors) > 0) {
    exit(1);
}

exit(0);
