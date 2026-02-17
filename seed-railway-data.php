<?php

/**
 * Seed Railway Database with Sample Data
 * Run: php seed-railway-data.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Category;
use App\Models\Product;

echo "========================================\n";
echo "Seeding Railway Database\n";
echo "========================================\n\n";

try {
    // Create Categories
    echo "Creating categories...\n";
    $categories = [
        ['name' => 'Electronics', 'description' => 'Electronic devices and accessories', 'is_active' => 1],
        ['name' => 'Clothing', 'description' => 'Apparel and fashion items', 'is_active' => 1],
        ['name' => 'Food & Beverages', 'description' => 'Food and drink products', 'is_active' => 1],
        ['name' => 'Books', 'description' => 'Books and publications', 'is_active' => 1],
        ['name' => 'Home & Garden', 'description' => 'Home and garden supplies', 'is_active' => 1],
    ];
    
    foreach ($categories as $cat) {
        Category::create($cat);
        echo "✅ Created category: {$cat['name']}\n";
    }
    
    echo "\n";
    
    // Create Products
    echo "Creating products...\n";
    $products = [
        ['category_id' => 1, 'name' => 'Wireless Mouse', 'sku' => 'ELEC-001', 'price' => 25.99, 'cost' => 15.00, 'stock' => 50, 'min_stock' => 10, 'is_active' => 1],
        ['category_id' => 1, 'name' => 'USB Cable', 'sku' => 'ELEC-002', 'price' => 9.99, 'cost' => 5.00, 'stock' => 100, 'min_stock' => 20, 'is_active' => 1],
        ['category_id' => 1, 'name' => 'Bluetooth Speaker', 'sku' => 'ELEC-003', 'price' => 49.99, 'cost' => 30.00, 'stock' => 30, 'min_stock' => 5, 'is_active' => 1],
        ['category_id' => 1, 'name' => 'Phone Charger', 'sku' => 'ELEC-004', 'price' => 19.99, 'cost' => 10.00, 'stock' => 75, 'min_stock' => 15, 'is_active' => 1],
        ['category_id' => 2, 'name' => 'T-Shirt', 'sku' => 'CLO-001', 'price' => 15.99, 'cost' => 8.00, 'stock' => 60, 'min_stock' => 10, 'is_active' => 1],
        ['category_id' => 2, 'name' => 'Jeans', 'sku' => 'CLO-002', 'price' => 39.99, 'cost' => 20.00, 'stock' => 40, 'min_stock' => 8, 'is_active' => 1],
        ['category_id' => 2, 'name' => 'Cap', 'sku' => 'CLO-003', 'price' => 12.99, 'cost' => 6.00, 'stock' => 45, 'min_stock' => 10, 'is_active' => 1],
        ['category_id' => 3, 'name' => 'Coffee', 'sku' => 'FOOD-001', 'price' => 8.99, 'cost' => 4.00, 'stock' => 80, 'min_stock' => 20, 'is_active' => 1],
        ['category_id' => 3, 'name' => 'Energy Drink', 'sku' => 'FOOD-002', 'price' => 2.99, 'cost' => 1.50, 'stock' => 120, 'min_stock' => 30, 'is_active' => 1],
        ['category_id' => 3, 'name' => 'Snack Bar', 'sku' => 'FOOD-003', 'price' => 1.99, 'cost' => 0.80, 'stock' => 150, 'min_stock' => 40, 'is_active' => 1],
        ['category_id' => 4, 'name' => 'Novel', 'sku' => 'BOOK-001', 'price' => 14.99, 'cost' => 8.00, 'stock' => 35, 'min_stock' => 5, 'is_active' => 1],
        ['category_id' => 4, 'name' => 'Magazine', 'sku' => 'BOOK-002', 'price' => 5.99, 'cost' => 3.00, 'stock' => 50, 'min_stock' => 10, 'is_active' => 1],
        ['category_id' => 5, 'name' => 'Plant Pot', 'sku' => 'HOME-001', 'price' => 12.99, 'cost' => 6.00, 'stock' => 40, 'min_stock' => 8, 'is_active' => 1],
        ['category_id' => 5, 'name' => 'Candle', 'sku' => 'HOME-002', 'price' => 7.99, 'cost' => 3.50, 'stock' => 60, 'min_stock' => 12, 'is_active' => 1],
        ['category_id' => 5, 'name' => 'Picture Frame', 'sku' => 'HOME-003', 'price' => 18.99, 'cost' => 10.00, 'stock' => 25, 'min_stock' => 5, 'is_active' => 1],
    ];
    
    foreach ($products as $prod) {
        Product::create($prod);
        echo "✅ Created product: {$prod['name']}\n";
    }
    
    echo "\n========================================\n";
    echo "✅ Sample data loaded successfully!\n";
    echo "========================================\n\n";
    
    echo "Summary:\n";
    echo "- Categories: " . Category::count() . "\n";
    echo "- Products: " . Product::count() . "\n";
    echo "- Users: 2 (admin + cashier)\n\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
