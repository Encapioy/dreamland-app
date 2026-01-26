<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // === 1. BUAT DATA MAKANAN ===

        // Produk: Savory Taste Sandwich
        $savory = Product::create([
            'name' => 'Savory Taste Sandwich',
            'type' => 'food',
            'is_available' => true
        ]);
        // Varian Savory Taste Sandwich
        ProductVariant::create(['product_id' => $savory->id, 'name' => 'Original', 'price' => 25000]);

        // Produk: Fried Sandwich
        $sandwich = Product::create([
            'name' => 'Fried Sandwich',
            'type' => 'food',
            'is_available' => true
        ]);
        // Varian Fried Sandwich
        ProductVariant::create(['product_id' => $sandwich->id, 'name' => 'Chocolate', 'price' => 25000]);
        ProductVariant::create(['product_id' => $sandwich->id, 'name' => 'Matcha', 'price' => 25000]);
        ProductVariant::create(['product_id' => $sandwich->id, 'name' => 'Strawberry', 'price' => 25000]);

        // Produk: stik kentang
        $kentang = Product::create([
            'name' => 'Stik Kentang',
            'type' => 'food',
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $kentang->id, 'name' => 'Original', 'price' => 22000]);


        // === 2. BUAT DATA MINUMAN ===

        // Produk: Goguma Latte
        $goguma = Product::create([
            'name' => 'Goguma Latte',
            'type' => 'drink', // Penting: Type Drink
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $goguma->id, 'name' => 'Original', 'price' => 25000]);

        // Produk: strawberry
        $strawberry = Product::create([
            'name' => 'Korean Milk Strawberry',
            'type' => 'drink',
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $strawberry->id, 'name' => 'Original', 'price' => 25000]);

        // Produk: Banana Pudding
        $puding = Product::create([
            'name' => 'Banana Pudding',
            'type' => 'drink',
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $puding->id, 'name' => 'Original', 'price' => 37000]);
    }
}
