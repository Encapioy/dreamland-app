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

        // Produk: Nasi Goreng
        $nasgor = Product::create([
            'name' => 'Nasi Goreng',
            'type' => 'food',
            'is_available' => true
        ]);
        // Varian Nasi Goreng
        ProductVariant::create(['product_id' => $nasgor->id, 'name' => 'Biasa', 'price' => 15000]);
        ProductVariant::create(['product_id' => $nasgor->id, 'name' => 'Spesial (Telur)', 'price' => 18000]);
        ProductVariant::create(['product_id' => $nasgor->id, 'name' => 'Seafood', 'price' => 22000]);

        // Produk: Sosis Bakar
        $sosis = Product::create([
            'name' => 'Sosis Bakar',
            'type' => 'food',
            'is_available' => true
        ]);
        // Varian Sosis
        ProductVariant::create(['product_id' => $sosis->id, 'name' => 'Original', 'price' => 10000]);
        ProductVariant::create(['product_id' => $sosis->id, 'name' => 'Pedas BBQ', 'price' => 12000]);
        ProductVariant::create(['product_id' => $sosis->id, 'name' => 'Keju Meleleh', 'price' => 13000]);

        // Produk: Dimsum
        $dimsum = Product::create([
            'name' => 'Dimsum',
            'type' => 'food',
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $dimsum->id, 'name' => 'Ayam (Isi 4)', 'price' => 15000]);
        ProductVariant::create(['product_id' => $dimsum->id, 'name' => 'Udang (Isi 4)', 'price' => 18000]);


        // === 2. BUAT DATA MINUMAN ===

        // Produk: Es Teh
        $esteh = Product::create([
            'name' => 'Es Teh',
            'type' => 'drink', // Penting: Type Drink
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $esteh->id, 'name' => 'Manis', 'price' => 5000]);
        ProductVariant::create(['product_id' => $esteh->id, 'name' => 'Tawar', 'price' => 3000]);
        ProductVariant::create(['product_id' => $esteh->id, 'name' => 'Lemon Tea', 'price' => 7000]);

        // Produk: Kopi
        $kopi = Product::create([
            'name' => 'Kopi',
            'type' => 'drink',
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $kopi->id, 'name' => 'Hitam Panas', 'price' => 10000]);
        ProductVariant::create(['product_id' => $kopi->id, 'name' => 'Susu Dingin', 'price' => 12000]);

        // Produk: Mineral
        $air = Product::create([
            'name' => 'Air Mineral',
            'type' => 'drink',
            'is_available' => true
        ]);
        ProductVariant::create(['product_id' => $air->id, 'name' => 'Botol 600ml', 'price' => 4000]);
    }
}