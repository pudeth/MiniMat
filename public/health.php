<?php
/**
 * Health Check Endpoint
 * Access: https://your-app.railway.app/health.php
 */

header('Content-Type: application/json');

$health = [
    'status' => 'ok',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'checks' => []
];

// Check PHP extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach ($requiredExtensions as $ext) {
    $health['checks']['extension_' . $ext] = extension_loaded($ext) ? 'ok' : 'missing';
    if (!extension_loaded($ext)) {
        $health['status'] = 'error';
    }
}

// Check Laravel
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $health['checks']['laravel'] = 'ok';
    $health['laravel_version'] = $app->version();
} catch (Exception $e) {
    $health['checks']['laravel'] = 'error: ' . $e->getMessage();
    $health['status'] = 'error';
}

// Check environment
$health['checks']['app_key'] = getenv('APP_KEY') ? 'set' : 'missing';
$health['checks']['app_env'] = getenv('APP_ENV') ?: 'not set';
$health['checks']['db_host'] = getenv('DB_HOST') ? 'set' : 'missing';

if (!getenv('APP_KEY')) {
    $health['status'] = 'error';
}

// Check database connection
if (getenv('DB_HOST')) {
    try {
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        DB::connection()->getPdo();
        $health['checks']['database'] = 'connected';
    } catch (Exception $e) {
        $health['checks']['database'] = 'error: ' . $e->getMessage();
        $health['status'] = 'warning';
    }
} else {
    $health['checks']['database'] = 'not configured';
}

// Check storage permissions
$storagePath = __DIR__ . '/../storage/logs';
$health['checks']['storage_writable'] = is_writable($storagePath) ? 'ok' : 'not writable';

http_response_code($health['status'] === 'ok' ? 200 : 500);
echo json_encode($health, JSON_PRETTY_PRINT);
