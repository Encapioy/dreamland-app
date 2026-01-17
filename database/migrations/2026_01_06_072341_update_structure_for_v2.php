<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Tambah kolom Telepon di tabel Orders
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_phone')->nullable()->after('customer_name');
        });

        // 2. Tambah status Stok di tabel Product Variants (Pindah dari Product induk)
        Schema::table('product_variants', function (Blueprint $table) {
            $table->boolean('is_available')->default(true)->after('price');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_phone');
        });
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('is_available');
        });
    }
};
