<?php
/**
 * Deployment Readiness Checker
 * Run this script to verify your Laravel application is ready for deployment
 */

echo "=== Laravel Deployment Readiness Check ===\n\n";

$checks = [];
$errors = [];
$warnings = [];

// Check 1: PHP Version
echo "1. Checking PHP version...\n";
$phpVersion = phpversion();
if (version_compare($phpVersion, '8.1.0', '>=')) {
    $checks[] = "✓ PHP version: $phpVersion (OK)";
} else {
    $errors[] = "✗ PHP version: $phpVersion (Requires >= 8.1.0)";
}

// Check 2: Required PHP Extensions
echo "2. Checking PHP extensions...\n";
$requiredExtensions = ['pdo', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach ($requiredExtensions as $ext) {
    if (extension_loaded($ext)) {
        $checks[] = "✓ Extension $ext: Loaded";
    } else {
        $errors[] = "✗ Extension $ext: Missing";
    }
}

// Check 3: .env file
echo "3. Checking .env file...\n";
if (file_exists('.env')) {
    $checks[] = "✓ .env file exists";
    
    // Check critical env variables
    $envContent = file_get_contents('.env');
    $criticalVars = ['APP_KEY', 'DB_DATABASE', 'DB_USERNAME'];
    foreach ($criticalVars as $var) {
        if (strpos($envContent, "$var=") !== false) {
            $checks[] = "✓ $var is set";
        } else {
            $errors[] = "✗ $var is not set in .env";
        }
    }
    
    // Check if APP_DEBUG is false for production
    if (strpos($envContent, 'APP_DEBUG=false') !== false) {
        $checks[] = "✓ APP_DEBUG is set to false";
    } else {
        $warnings[] = "⚠ APP_DEBUG should be false in production";
    }
    
    // Check if APP_ENV is production
    if (strpos($envContent, 'APP_ENV=production') !== false) {
        $checks[] = "✓ APP_ENV is set to production";
    } else {
        $warnings[] = "⚠ APP_ENV should be 'production' for deployment";
    }
} else {
    $errors[] = "✗ .env file not found";
}

// Check 4: Storage permissions
echo "4. Checking storage permissions...\n";
$storageDirs = ['storage/app', 'storage/framework', 'storage/logs', 'bootstrap/cache'];
foreach ($storageDirs as $dir) {
    if (is_writable($dir)) {
        $checks[] = "✓ $dir is writable";
    } else {
        $errors[] = "✗ $dir is not writable (run: chmod -R 775 $dir)";
    }
}

// Check 5: Composer dependencies
echo "5. Checking composer dependencies...\n";
if (file_exists('vendor/autoload.php')) {
    $checks[] = "✓ Composer dependencies installed";
} else {
    $errors[] = "✗ Composer dependencies not installed (run: composer install)";
}

// Check 6: Key files exist
echo "6. Checking key files...\n";
$keyFiles = [
    'artisan',
    'composer.json',
    'public/index.php',
    'routes/web.php',
    'app/Http/Kernel.php'
];
foreach ($keyFiles as $file) {
    if (file_exists($file)) {
        $checks[] = "✓ $file exists";
    } else {
        $errors[] = "✗ $file is missing";
    }
}

// Check 7: .gitignore
echo "7. Checking .gitignore...\n";
if (file_exists('.gitignore')) {
    $gitignore = file_get_contents('.gitignore');
    if (strpos($gitignore, '.env') !== false) {
        $checks[] = "✓ .env is in .gitignore";
    } else {
        $errors[] = "✗ .env should be in .gitignore";
    }
    if (strpos($gitignore, '/vendor') !== false) {
        $checks[] = "✓ /vendor is in .gitignore";
    } else {
        $warnings[] = "⚠ /vendor should be in .gitignore";
    }
} else {
    $warnings[] = "⚠ .gitignore file not found";
}

// Check 8: Database migrations
echo "8. Checking database migrations...\n";
$migrations = glob('database/migrations/*.php');
if (count($migrations) > 0) {
    $checks[] = "✓ Found " . count($migrations) . " migration files";
} else {
    $warnings[] = "⚠ No migration files found";
}

// Print Results
echo "\n=== RESULTS ===\n\n";

if (!empty($checks)) {
    echo "PASSED CHECKS:\n";
    foreach ($checks as $check) {
        echo "$check\n";
    }
    echo "\n";
}

if (!empty($warnings)) {
    echo "WARNINGS:\n";
    foreach ($warnings as $warning) {
        echo "$warning\n";
    }
    echo "\n";
}

if (!empty($errors)) {
    echo "ERRORS (Must Fix):\n";
    foreach ($errors as $error) {
        echo "$error\n";
    }
    echo "\n";
}

// Final verdict
if (empty($errors)) {
    echo "✓✓✓ DEPLOYMENT READY ✓✓✓\n";
    if (!empty($warnings)) {
        echo "Note: Please review warnings before deploying.\n";
    }
    exit(0);
} else {
    echo "✗✗✗ NOT READY FOR DEPLOYMENT ✗✗✗\n";
    echo "Please fix the errors above before deploying.\n";
    exit(1);
}
