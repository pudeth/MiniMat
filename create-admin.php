<?php

/**
 * Create Admin User Script
 * Run this in Railway shell: php create-admin.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "========================================\n";
echo "Creating Admin User\n";
echo "========================================\n\n";

try {
    // Check if admin already exists
    $existingAdmin = User::where('email', 'admin@minimat.com')->first();
    
    if ($existingAdmin) {
        echo "⚠️  Admin user already exists!\n";
        echo "Email: admin@minimat.com\n";
        echo "To reset password, delete the user first.\n\n";
        exit(0);
    }

    // Create admin user
    $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@minimat.com',
        'password' => bcrypt('Admin@123'),
        'role' => 'admin',
        'is_active' => 1,
    ]);

    echo "✅ Admin user created successfully!\n\n";
    echo "Login credentials:\n";
    echo "Email: admin@minimat.com\n";
    echo "Password: Admin@123\n\n";
    echo "⚠️  IMPORTANT: Change this password after first login!\n\n";

    // Create a cashier user too
    $cashier = User::create([
        'name' => 'Cashier',
        'email' => 'cashier@minimat.com',
        'password' => bcrypt('Cashier@123'),
        'role' => 'cashier',
        'is_active' => 1,
    ]);

    echo "✅ Cashier user created successfully!\n\n";
    echo "Login credentials:\n";
    echo "Email: cashier@minimat.com\n";
    echo "Password: Cashier@123\n\n";

    echo "========================================\n";
    echo "Total users created: 2\n";
    echo "========================================\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
