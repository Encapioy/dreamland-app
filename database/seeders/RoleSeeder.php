<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {

        // ===== 2. USER AUTH =====
        // Hapus user lama biar gak duplikat kalo di-seed ulang
        // User::truncate();

        $password = Hash::make('takisikat'); // Password Global

        // 1. KASIR
        User::create([
            'name' => 'Kasir Pemesanan',
            'email' => 'kasir', // Kita pake kolom email sebagai username biar gak usah ubah struktur tabel
            'password' => $password,
        ]);

        // 2. DAPUR MAKANAN
        User::create([
            'name' => 'Chef Makanan',
            'email' => 'dapur_food',
            'password' => $password,
        ]);

        // 3. DAPUR MINUMAN
        User::create([
            'name' => 'Chef Minuman',
            'email' => 'dapur_drink',
            'password' => $password,
        ]);

        // 4. WAITER
        User::create([
            'name' => 'Waiter Team',
            'email' => 'waiter',
            'password' => $password,
        ]);

        // 5. SALES
        User::create([
            'name' => 'Sales Team',
            'email' => 'sales',
            'password' => $password,
        ]);
    }
}